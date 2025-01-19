<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-50 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-12 h-full bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg border border-stone-800 backdrop-blur-sm">
                <!-- Header Section -->
                <div class="p-6 border-b border-stone-800">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-semibold text-stone-50 tracking-wide">
                                Shopping Cart
                            </h2>
                            <p class="mt-2 text-sm text-stone-400">
                                You have {{ $cartItems->count() }} items in your cart
                            </p>
                        </div>
                        <button type="button" 
                                onclick="location.href='{{ route('catalogue') }}'" 
                                class="mt-4 sm:mt-0 px-6 py-2 bg-gradient-to-r from-stone-800 to-stone-900 text-stone-50 rounded-lg border border-stone-700 hover:from-stone-700 hover:to-stone-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-stone-600 focus:ring-offset-2 focus:ring-offset-stone-900 font-medium tracking-wide shadow-md">
                            Continue Shopping
                        </button>
                    </div>
                </div>

                <!-- Cart Items -->
                <div class="p-6">
                    @livewire('cart-list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


