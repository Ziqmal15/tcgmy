<?php

namespace App\Http\Controllers\User;

use App\Models\Card;
use App\Models\Cart;
use App\Models\User;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $cart = $user->cart;
        
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id
            ]);
        }
        
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->where('status', 'pending')
            ->get();
        
        return view('pages.user.cart.index', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $cart = User::find(Auth::user()->id)->cart;
        
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::user()->id
            ]);
        }

        $cartItem = $cart->cartItems()->where('card_id', $request->card_id)
            ->where('status', 'pending')
            ->first();
            
        if ($cartItem) {
            if($cartItem->quantity + $request->quantity > $cartItem->card->stock){
                return redirect()->back()->with('error', 'Stock is not enough');
            }
            if($cartItem->status == 'pending'){
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $request->quantity,
                    'price' => $cartItem->price + $request->price,
                ]);
            }
            else{
                CartItem::create([
                    'cart_id' => $cart->id,
                    'card_id' => $request->card_id,
                    'quantity' => $request->quantity,
                    'price' => $request->price * $request->quantity,
                    'status' => 'pending',
                ]);
            }
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'card_id' => $request->card_id,
                'quantity' => $request->quantity,
                'price' => $request->price * $request->quantity,
                'status' => 'pending',
            ]);
        }

        $card = Card::find($request->card_id);
        $card->stock -= $request->quantity;
        $card->save();

        return redirect()->route('user.cart.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $cart = Auth::user()->cart;
    $cartItem = $cart->cartItems()->findOrFail($id);
    $cartItem->delete();

    return redirect()->route('user.cart.index')->with('success', 'Item removed from cart successfully.');
    }

    public function remove(Request $request, $id)
    {
        // Handle removing the item from cart logic here
        return redirect()->route('user.cart.index');
    }
}
