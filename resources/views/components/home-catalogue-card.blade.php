@props([
    'link' => '#',
    'title' => 'Pokemon Trading Card Game',
    'image' => '#',
    'price' => '$599',
    'rating' => 4.5,
    'rarity' => 'Full Art',
    'stock' => '1',
    'series' => 'Vanguard',
    'set' => 'Link Joker',
])

<div class="group relative flex-shrink-0 w-[280px]">
    <!-- Card Container -->
    <div class="relative h-full bg-gradient-to-br from-stone-900/90 to-stone-800/90 overflow-hidden rounded-2xl border border-stone-800/50 backdrop-blur-sm transition-all duration-300 group-hover:border-amber-500/50 group-hover:shadow-lg group-hover:shadow-amber-500/10">
        <!-- Product Image Container -->
        <div class="p-4">
            <a href="{{ $link }}" class="block relative group">
                <!-- Image Background Glow -->
                <div class="absolute inset-0 bg-gradient-to-br from-amber-500/[0.05] to-stone-900/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <!-- Image Container -->
                <div class="relative overflow-hidden rounded-xl border border-stone-700/50 bg-gradient-to-br from-stone-800 to-stone-900">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/[0.02] to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <img class="w-full h-52 object-contain p-3 transform transition-transform duration-500 group-hover:scale-105" 
                         src="{{ asset("storage/$image") }}" 
                         alt="{{ $title }}">
                </div>
            </a>

            <!-- Product Details -->
            <div class="mt-4 space-y-3">
                <!-- Title -->
                <a href="{{ $link }}" 
                   class="block text-base font-bold text-transparent bg-clip-text bg-gradient-to-r from-stone-100 to-stone-300 hover:from-amber-200 hover:to-amber-400 transition-all duration-300 truncate">
                    {{ $title }}
                </a>
                
                <!-- Series & Set Info -->
                <div class="flex items-center gap-2 text-xs text-stone-400">
                    <div class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-amber-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="font-medium text-stone-300 truncate">{{ $series }}</span>
                    </div>
                    <div class="h-1 w-1 rounded-full bg-stone-700"></div>
                    <div class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-amber-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        <span class="font-medium text-stone-300 truncate">{{ $set }}</span>
                    </div>
                </div>
                
                <!-- Price & Rarity -->
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">
                        RM{{ $price }}
                    </span>
                    <span class="text-[10px] font-medium text-amber-400/90 px-2 py-0.5 bg-amber-500/10 rounded-full border border-amber-500/20">
                        {{ strtoupper($rarity) }}
                    </span>
                </div>

                <!-- Stock Info -->
                <div class="flex items-center gap-1.5">
                    @if($stock > 0)
                        <div class="flex items-center gap-1 text-xs text-emerald-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="font-medium">In Stock</span>
                        </div>
                    @else
                        <div class="flex items-center gap-1 text-xs text-red-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="font-medium">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <!-- Action Button -->
                <div>
                    <a href="{{ $link }}" 
                       class="group/btn relative block w-full">
                        <!-- Button Glow Effect -->
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-amber-500/0 via-amber-500/20 to-amber-500/0 rounded-lg opacity-0 blur transition duration-500 group-hover/btn:opacity-100"></div>
                        
                        <!-- Button Content -->
                        <div class="relative flex items-center justify-center gap-1.5 px-3 py-2 bg-gradient-to-r from-amber-600 to-amber-800 text-stone-50 text-xs font-semibold rounded-lg border border-amber-700/50 transition-all duration-300 group-hover/btn:from-amber-500 group-hover/btn:to-amber-700">
                            <span>View Product</span>
                            <svg class="w-3.5 h-3.5 transform transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
