<div>
    <form class="max-w-xs">
        <label for="quantity-input" class="block mb-2 text-sm font-medium text-white">Choose quantity:</label>
        <div class="flex items-center mb-4">
            <button type="button" class="px-2 py-1 bg-stone-500 text-white rounded hover:bg-gray-300" wire:click="decreaseQuantity">-</button>
            <span class="mx-2 text-sm text-white">{{ $quantity }}</span>
            <button type="button" class="px-2 py-1 bg-stone-500 text-white rounded hover:bg-gray-300" wire:click="increaseQuantity">+</button>
        </div>
        <p class="mt-2 text-sm text-white">Add Quantity</p>
    </form>
    <div class="flex space-x-4 mb-6">
        <button wire:click="addToCart" class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            Add to Cart
        </button>
    </div>
</div> 