<?php

namespace App\Livewire;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartList extends Component
{
    public ?Collection $cartItems = null;
    public array $selectedItems = [];
    public float $selectedTotal = 0;
    public float $subtotal = 0;
    public string $couponCode = '';
    public float $discount = 0;
    public $coupon;

    public function mount(): void
    {
        $this->cartItems = Auth::check()
            ? Cart::where('user_id', User::find(Auth::user()->id)->id)
                ->first()?->cartItems()
                ->where('status', 'pending')
                ->get() ?? collect()
            : collect();
    }

    public function useCoupon()
    {
        $coupon = Coupon::where('code', $this->couponCode)->first();

        if (!$coupon) {
            session()->flash('error', 'Invalid coupon code');
            return;
        }

        // Check if coupon is valid (active and within date range)
        if (!$coupon->isValid()) {
            session()->flash('error', 'This coupon has already been used or is no longer valid');
            return;
        }

        // Check if user has already used this coupon
        $userUsage = $coupon->users()
            ->where('user_id', User::find(Auth::user()->id)->id)
            ->where('is_used', true)
            ->exists();

        if ($userUsage) {
            session()->flash('error', 'You have already used this coupon');
            return;
        }

        // Calculate raw total before applying coupon
        $this->subtotal = $this->calculateRawTotal();

        // Check minimum spend requirement
        if ($this->subtotal < $coupon->min_spend) {
            session()->flash('error', 'Order total does not meet minimum spend requirement of RM' . number_format($coupon->min_spend, 2));
            return;
        }

        // Store the coupon
        $this->coupon = $coupon;

        // Calculate and apply discount
        $this->discount = $coupon->calculateDiscount($this->subtotal);
        $this->selectedTotal = $this->subtotal - $this->discount;

        session()->flash('message', 'Coupon applied successfully!');
    }

    protected function calculateRawTotal(): float
    {
        return $this->cartItems
            ->whereIn('id', $this->selectedItems)
            ->sum(function ($item) {
                return $item->price * $item->quantity;
            });
    }

    public function increaseQuantity(int $itemId): void
    {
        try {
            $cartItem = CartItem::findOrFail($itemId);
            $card = $cartItem->card;

            if ($card->stock <= 0) {
                $this->dispatch('toast', 
                    message: 'Item is out of stock',
                    type: 'error'
                );
                return;
            }

            DB::transaction(function () use ($cartItem, $card) {
                $cartItem->quantity += 1;
                $card->stock -= 1;
                
                $cartItem->save();
                $card->save();
            });
        } catch (Exception $e) {
            $this->dispatch('toast', 
                message: 'Failed to update quantity',
                type: 'error'
            );
        }
    }

    public function decreaseQuantity(int $itemId): void
    {
        try {
            $cartItem = CartItem::findOrFail($itemId);
            $card = $cartItem->card;

            if ($cartItem->quantity <= 1) {
                $this->removeItem($itemId);
                return;
            }

            DB::transaction(function () use ($cartItem, $card) {
                $cartItem->quantity -= 1;
                $card->stock += 1;
                
                $cartItem->save();
                $card->save();
            });
        } catch (Exception $e) {
            $this->dispatch('toast', 
                message: 'Failed to update quantity',
                type: 'error'
            );
        }
    }

    public function updateTotal(): void
    {
        // Calculate raw total first (this is our subtotal)
        $this->subtotal = $this->calculateRawTotal();
        $this->selectedTotal = $this->subtotal;
        $this->discount = 0; // Reset discount by default

        // Reapply coupon if exists
        if ($this->coupon) {
            // Validate minimum spend again when updating total
            if ($this->subtotal < $this->coupon->min_spend) {
                session()->flash('error', 'Order total no longer meets minimum spend requirement. Coupon has been removed.');
                $this->coupon = null;
                $this->discount = 0;
                return;
            }

            // Calculate discount
            $this->discount = $this->coupon->calculateDiscount($this->subtotal);
            // Final total is subtotal minus discount
            $this->selectedTotal = $this->subtotal - $this->discount;
        }
    }

    public function removeItem(int $itemId): void
    {
        try {
            DB::transaction(function () use ($itemId) {
                $cartItem = CartItem::findOrFail($itemId);
                $card = $cartItem->card;
                
                $card->stock += $cartItem->quantity;
                $card->save();
                
                $cartItem->delete();
            });

            // Refresh cart items after removal
            $this->mount();
        } catch (Exception $e) {
            $this->dispatch('toast', 
                message: 'Failed to remove item',
                type: 'error'
            );
        }
    }

    public function submitOrder()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('toast', 
                message: 'Please select at least one item to proceed.',
                type: 'error'
            );
            return;
        }

        try {
            $order = DB::transaction(function () {
                // Revalidate coupon before order submission
                if ($this->coupon) {
                    if (!$this->coupon->isValid() || 
                        $this->coupon->isUsedInOrder() || 
                        $this->coupon->users()
                            ->where('user_id', User::find(Auth::user()->id)->id)
                            ->where('is_used', true)
                            ->exists()
                    ) {
                        throw new Exception('The coupon is no longer valid or has already been used');
                    }

                    // Recalculate discount one final time
                    $rawTotal = $this->cartItems
                        ->whereIn('id', $this->selectedItems)
                        ->sum(function ($item) {
                            return $item->price * $item->quantity;
                        });
                    $this->discount = $this->coupon->calculateDiscount($rawTotal);
                    $this->selectedTotal = $rawTotal - $this->discount;
                }

                // Validate stock availability for all selected items
                $cartItems = CartItem::whereIn('id', $this->selectedItems)->get();
                foreach ($cartItems as $cartItem) {
                    if ($cartItem->card->stock < $cartItem->quantity) {
                        throw new Exception("Insufficient stock for {$cartItem->card->name}");
                    }
                }

                // Create order
                $order = Order::create([
                    'user_id' => User::find(Auth::user()->id)->id,
                    'status' => 'pending',
                    'name' => User::find(Auth::user()->id)->name . '-' . now()->format('Y-m-d H:i:s'),
                    'coupon_id' => $this->coupon ? $this->coupon->id : null,
                    'subtotal' => $this->selectedTotal + $this->discount, // Original total before discount
                    'discount' => $this->discount,
                    'total' => $this->selectedTotal // Final total after discount
                ]);

                // Create order items and update cart items
                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'cartItem_id' => $cartItem->id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->price
                    ]);
                    
                    // Update cart item status
                    $cartItem->update(['status' => 'ordered']);
                    
                    // Update card stock
                    $cartItem->card->decrement('stock', $cartItem->quantity);
                }

                // If there's a coupon, mark it as used
                if ($this->coupon) {
                    $this->coupon->users()->attach(User::find(Auth::user()->id)->id, [
                        'is_used' => true,
                        'used_at' => now()
                    ]);
                }

                return $order;
            });

            // Reset state
            $this->selectedItems = [];
            $this->selectedTotal = 0;
            $this->discount = 0;
            $this->couponCode = '';
            $this->coupon = null;
            $this->mount();

            // Ensure redirection happens after successful order creation
            if ($order) {
                return redirect()->route('user.checkout.create', ['id' => $order->id]);
            }

        } catch (Exception $e) {
            $this->dispatch('toast', 
                message: $e->getMessage(),
                type: 'error'
            );
        }
    }

    public function copyCouponCode(string $code): void
    {
        try {
            $this->dispatch('copyToClipboard', code: $code);
            
            $this->dispatch('toast', 
                message: 'Coupon code copied to clipboard!',
                type: 'success'
            );
        } catch (Exception $e) {
            $this->dispatch('toast', 
                message: 'Failed to copy coupon code',
                type: 'error'
            );
        }
    }

    public function updatedSelectedItems()
    {
        $this->updateTotal();
    }

    public function render()
    {
        return view('livewire.cart-list', ['cartItems' => $this->cartItems]);
    }
}
