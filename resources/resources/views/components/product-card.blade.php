@props([
    'link' => '#',
    'title' => 'Blaster Joker',
    'price' => '$599',
    'rating' => 4.5,
    'rarity' => 'Full Art',
    'image' => 'img/card/blaster-joker.webp',
    'stock' => '1',
    'series' => 'Vanguard',
    'set' => 'Link Joker',
    'id' => null,
    'editStockLink' => '#',
    'deleteStockLink' => '#'
])

<div class="w-full md:w-1/4 p-4">
    <!-- Container with rounded corners and visible background -->
    <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg border border-stone-800 backdrop-blur-sm">
        <!-- Product Details -->
        <div class="p-4">
            <img src="{{ asset("storage/$image") }}" alt="{{ $title }}" class="w-full h-48 object-contain rounded-lg border border-stone-700 bg-stone-800">
            <a href="{{ $link }}" class="block mt-4 text-lg font-semibold text-stone-50 hover:text-amber-500 transition-colors duration-300">{{ $title }}</a>
            <p class="text-sm text-stone-300 mt-2">Series: <span class="font-medium text-stone-50">{{ $series }}</span> | Set: <span class="font-medium text-stone-50">{{ $set }}</span></p>
            <div class="mt-3 flex items-center justify-between">
                <span class="text-lg font-bold text-amber-500">RM {{ $price }}</span>
                <span class="text-xs text-stone-300 px-2 py-1 bg-stone-800 rounded-full">{{ strtoupper($rarity) }}</span>
            </div>
            <div class="mt-3">
                <div class="text-sm {{ $stock > 0 ? 'text-green-500' : 'text-red-500' }}">
                    {{ $stock > 0 ? 'In Stock: ' . $stock : 'Out of Stock' }}
                </div>
            </div>
            <div class="mt-4 space-y-2">
                <a href="{{ $link }}" class="w-full block text-center py-2 bg-stone-700 text-stone-50 text-sm font-semibold rounded-lg border border-stone-600 hover:bg-stone-600 transition-all duration-300">
                    View Product
                </a>
                @auth
                    @if(Auth::user()->roles === 0)
                        <form action="{{ route('user.cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="card_id" value="{{ $id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="price" value="{{ $price }}">
                            <button type="submit" formaction="{{ route('user.cart.index') }}" class="w-full block text-center py-2 bg-gradient-to-r from-amber-700 to-amber-900 text-stone-50 text-sm font-semibold rounded-lg border border-amber-700 hover:from-amber-600 hover:to-amber-800 transition-all duration-300">
                                Add To Cart
                            </button>
                        </form>
                    @endif
                    @if(Auth::user()->roles === 1)
                        <div class="flex gap-2">
                            <a href="{{ $editStockLink }}" class="w-full block text-center py-2 bg-gradient-to-r from-amber-700 to-amber-900 text-stone-50 text-sm font-semibold rounded-lg border border-amber-700 hover:from-amber-600 hover:to-amber-800 transition-all duration-300">
                                Edit
                            </a>
                            <!-- Modal Code -->
                        </div>
                    @endif
                @else
                    <div class="flex gap-2">
                        <button @click="modalOpen=true" class="w-full block text-center py-2 bg-gradient-to-r from-amber-700 to-amber-900 text-stone-50 text-sm font-semibold rounded-lg border border-amber-700 hover:from-amber-600 hover:to-amber-800 transition-all duration-300">
                            Add To Cart
                        </button>
                        <!-- Modal Code -->
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
