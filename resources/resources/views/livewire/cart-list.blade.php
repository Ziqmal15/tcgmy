<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div>
        <div class="bg-stone-900/50 rounded-xl border border-stone-800/50 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-stone-800">
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Card</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Quantity</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-stone-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-800/50">
                        @if($cartItems->count() > 0)    
                            @foreach($cartItems as $item)
                                <tr class="hover:bg-stone-800/30 transition-colors group">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center">
                                                <input type="checkbox" 
                                                    class="rounded-lg bg-stone-800 border-stone-700 text-blue-500 focus:ring-blue-500 focus:ring-offset-stone-900" 
                                                    value="{{ $item->id }}" 
                                                    wire:model="selectedItems"
                                                    wire:change="updateTotal"
                                                    data-price="{{ $item->price }}">
                                            </div>
                                            @php
                                                $image = $item->card->image;
                                            @endphp
                                            <a href="{{ route('catalogue.show', $item->card->id) }}" class="relative group">
                                                <div class="relative">
                                                    <img class="h-16 w-16 rounded-lg object-cover border-2 border-stone-700 group-hover:border-blue-500 transition-all duration-300 transform group-hover:scale-105" 
                                                        src="{{ asset("storage/$image") }}" 
                                                        alt="{{ $item->card->card_name }}">
                                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                                </div>
                                            </a>
                                            <a href="{{ route('catalogue.show', $item->card->id) }}" class="text-stone-50 hover:text-blue-400 transition-colors font-medium">
                                                {{ $item->card->card_name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-3">
                                            <button type="button" class="w-8 h-8 rounded-lg bg-stone-800 text-stone-300 hover:bg-stone-700 hover:text-stone-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-stone-600" wire:click="decreaseQuantity({{ $item->id }})">-</button>
                                            <span class="text-stone-50 font-medium w-8 text-center">{{ $item->quantity }}</span>
                                            <button type="button" class="w-8 h-8 rounded-lg bg-stone-800 text-stone-300 hover:bg-stone-700 hover:text-stone-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-stone-600" wire:click="increaseQuantity({{ $item->id }})">+</button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-stone-50 font-medium">RM {{ $item->card->price }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-stone-50 font-medium">RM {{ $item->price }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('catalogue.show', $item->card->id) }}" 
                                               class="px-4 py-2 bg-stone-800 text-stone-50 rounded-lg border border-stone-700 hover:bg-stone-700 hover:border-stone-600 transition-all duration-200 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-stone-600">
                                                View
                                            </a>
                                            <button type="button" 
                                                    wire:click="removeItem({{ $item->id }})"
                                                    class="px-4 py-2 bg-red-900/80 text-stone-50 rounded-lg border border-red-800 hover:bg-red-800 hover:border-red-700 transition-all duration-200 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-red-600">
                                                Remove
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <svg class="w-16 h-16 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                        <p class="text-stone-400 text-lg">Your cart is empty</p>
                                        
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cart Summary and Coupon Section -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Coupon Section -->
            <div class="bg-stone-900/50 rounded-xl border border-stone-800/50 p-6 shadow-xl">
                <h3 class="text-stone-50 font-semibold mb-4">Apply Coupon</h3>
                <div class="flex items-center space-x-4">
                    <input
                        type="text" 
                        wire:model="couponCode" 
                        placeholder="Enter coupon code"
                        class="flex-1 px-4 py-2.5 bg-stone-800 border border-stone-700 rounded-lg text-stone-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-stone-500"
                    />
                    <button
                        type="button"
                        wire:click="useCoupon"
                        class="px-6 py-2.5 bg-gradient-to-r from-stone-700 to-stone-800 text-stone-50 rounded-lg hover:from-stone-600 hover:to-stone-700 transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-stone-600 focus:ring-offset-2 focus:ring-offset-stone-900"
                    >
                        Apply
                    </button>
                </div>

                <!-- Coupon Messages -->
                @if (session()->has('message'))
                    <div class="mt-3 px-4 py-2 bg-green-900/50 border border-green-800 rounded-lg">
                        <p class="text-green-400 text-sm">{{ session('message') }}</p>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="mt-3 px-4 py-2 bg-red-900/50 border border-red-800 rounded-lg">
                        <p class="text-red-400 text-sm">{{ session('error') }}</p>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="bg-stone-900/50 rounded-xl border border-stone-800/50 p-6 shadow-xl">
                <h3 class="text-stone-50 font-semibold mb-4">Order Summary</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-stone-800">
                        <span class="text-stone-400">Subtotal</span>
                        <span class="text-stone-50 text-lg">RM {{ number_format($subtotal, 2) }}</span>
                    </div>
                    
                    @if($discount > 0)
                        <div class="flex justify-between items-center pb-4 border-b border-stone-800">
                            <span class="text-stone-400">Discount</span>
                            <span class="text-green-400 text-lg">-RM {{ number_format($discount, 2) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center pt-2">
                        <span class="text-stone-50 font-medium">Final Total</span>
                        <span class="text-stone-50 text-xl font-bold">RM {{ number_format($selectedTotal - $discount, 2) }}</span>
                    </div>

                    <button type="button" 
                            x-data
                            @click="$dispatch('open-modal', 'confirm-checkout')"
                            class="w-full mt-6 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-500 hover:to-blue-600 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-stone-900 font-semibold tracking-wide shadow-lg disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-[1.02]"
                            @disabled(empty($selectedItems))>
                        <div  class="flex items-center justify-center space-x-2">
                            
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span>Proceed to Checkout</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div
        x-data="{ 
            show: false,
            modalName: 'confirm-checkout'
        }"
        x-show="show"
        x-on:open-modal.window="if ($event.detail === modalName) { show = true }"
        x-on:close-modal.window="if ($event.detail === modalName) { show = false }"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        <!-- Modal Backdrop with blur effect -->
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Content -->
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div
                x-on:click.away="show = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-gradient-to-br from-stone-900 to-stone-800 rounded-2xl max-w-md w-full p-8 relative shadow-2xl border border-stone-700/50 transform transition-all"
            >
                <div class="text-center">
                    <!-- Decorative Element -->
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 w-16 h-1 rounded-full"></div>
                    </div>

                    <!-- Icon -->
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-4">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <h3 class="text-xl font-semibold text-stone-50 mb-3">Confirm Checkout</h3>
                    <p class="text-stone-300 mb-8">Are you sure you want to proceed with the selected items?</p>
                    
                    <div class="flex justify-center space-x-4">
                        <button
                            type="button"
                            x-on:click="show = false"
                            class="px-6 py-2.5 bg-stone-800 text-stone-50 rounded-lg hover:bg-stone-700 transition-all duration-200 border border-stone-700/50 hover:border-stone-600 shadow-sm hover:shadow-md font-medium"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            wire:click="submitOrder"
                            x-on:click="show = false"
                            wire:loading.attr="disabled"
                            wire:target="submitOrder"
                            class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white rounded-lg transition-all duration-200 shadow-sm hover:shadow-md disabled:opacity-50 font-medium transform hover:scale-[1.02]"
                        >
                            <span wire:loading.remove wire:target="submitOrder">
                                Confirm Order
                            </span>
                            <span wire:loading wire:target="submitOrder" class="flex items-center justify-center space-x-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Processing...</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

