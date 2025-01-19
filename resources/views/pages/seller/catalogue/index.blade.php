<link rel="icon" type="image/x-icon" href="/img/logo2.png">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-50 leading-tight tracking-wide">
            {{ __('Catalogue') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg p-8 border border-stone-800 backdrop-blur-sm">
                <div class="w-full flex flex-row justify-between items-center mb-8">
                    <h3 class="text-2xl font-semibold text-stone-50 tracking-wide">Card Stocks</h3>
                    <button type="button" 
                            class="bg-gradient-to-r from-stone-800 to-stone-900 text-stone-50 px-6 py-3 rounded-lg border border-stone-700 hover:from-stone-700 hover:to-stone-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-stone-600 focus:ring-offset-2 focus:ring-offset-stone-900 font-semibold tracking-wide shadow-md" 
                            onclick="location.href='{{ route('seller.catalogue.create') }}'">
                        {{ __('Add New Stocks') }}
                    </button>
                </div>

                <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @if ($cards->count() > 0)
                        @foreach ($cards as $card)
                            <div class="bg-stone-900 rounded-lg border border-stone-800 shadow-lg hover:border-stone-700 transition-all duration-300 overflow-hidden group">
                                <div class="aspect-[3/4] overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $card->image) }}" 
                                         alt="{{ $card->card_name }}"
                                         class="w-full h-full object-cover object-center transform group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-transparent opacity-60"></div>
                                </div>
                                
                                <div class="p-4 space-y-3">
                                    <h4 class="text-lg font-medium text-stone-50 truncate">{{ $card->card_name }}</h4>
                                    <div class="flex justify-between items-center">
                                        <span class="text-stone-400 text-sm">{{ $card->series }}</span>
                                        <span class="text-stone-50 font-semibold">RM {{ $card->price }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-stone-400">Stock: {{ $card->stock }}</span>
                                        <span class="text-emerald-500 font-medium">{{ $card->rarity }}</span>
                                    </div>
                                    
                                    <div class="flex gap-2 pt-2">
                                        <div class="flex-1">
                                            <a href="{{ route('seller.catalogue.edit', $card->id) }}" 
                                               class="w-full block text-center py-2 px-4 bg-neutral-800 text-neutral-300 rounded hover:bg-neutral-700 transition-colors text-sm">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="flex-1">
                                            <form action="{{ route('seller.catalogue.destroy', $card->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full py-2 px-4 bg-red-950 text-red-200 rounded hover:bg-red-900 transition-colors text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full p-8 text-center">
                            <div class="bg-stone-900/95 p-6 rounded-lg border border-stone-800 shadow-md">
                                <p class="text-stone-400 tracking-wide">{{ __("No product found!") }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-8">
                    @if ($cards instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $cards->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


