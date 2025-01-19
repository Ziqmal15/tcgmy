<div>
    <div class="relative mt-6 max-w-lg mx-auto py-4">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-5 w-5 text-stone-400" viewBox="0 0 24 24" fill="none">
                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <input wire:model.live="search" 
               class="w-full border border-stone-700 rounded-md pl-10 pr-4 py-2 focus:border-amber-500 focus:outline-none focus:shadow-outline bg-stone-800 text-stone-100 placeholder-stone-400" 
               type="text" 
               placeholder="{{ __('Search products...') }}">
    </div>
    
    @if($search)
    <div class="absolute z-50 mt-1 max-w-lg w-full left-1/2 -translate-x-1/2">
        @if($cards->isEmpty())
            <div class="bg-stone-900/95 p-4 rounded-lg border border-stone-700 shadow-lg backdrop-blur-sm">
                <p class="text-stone-400 tracking-wide">No cards found matching "{{ $search }}"</p>
            </div>
        @else
            <div class="bg-stone-900/95 rounded-lg border border-stone-700 shadow-lg max-h-96 overflow-y-auto backdrop-blur-sm">
                @foreach($cards as $card)
                    <a href="{{ route('catalogue.show', $card->id) }}" 
                       class="block hover:bg-stone-800/80 transition-colors duration-200">
                        <div class="flex items-center space-x-4 p-4 border-b border-stone-700 last:border-b-0">
                            <img src="{{ asset("storage/$card->image") }}" 
                                 alt="{{ $card->card_name }}" 
                                 class="w-16 h-16 object-contain rounded-md border border-stone-600 bg-stone-800">
                            <div class="flex-1">
                                <h3 class="text-stone-100 font-medium hover:text-amber-500 transition-colors duration-200">{{ $card->card_name }}</h3>
                                <p class="text-xs text-stone-400">
                                    {{ $card->series }} | {{ $card->set_code }} | 
                                    <span class="text-amber-500 font-semibold">RM {{ number_format($card->price, 2) }}</span>
                                </p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs px-2 py-0.5 bg-stone-800/80 text-stone-300 rounded-full border border-stone-700">
                                        {{ strtoupper($card->rarity) }}
                                    </span>
                                    <span class="ml-2 text-xs {{ $card->stock > 0 ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $card->stock > 0 ? 'In Stock: ' . $card->stock : 'Out of Stock' }}
                                    </span>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    @endif
</div> 