@php
    use App\Models\RatingNReview;
    use App\Models\Card;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-stone-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h2 class="font-semibold text-xl text-stone-50 leading-tight">
                {{ __('Catalogue') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 h-full bg-stone-950 bg-opacity-95">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Left Column - Product Images -->
                <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg p-6 border border-stone-800 backdrop-blur-sm hover:shadow-[0_0_15px_rgba(214,211,209,0.15)] transition-all duration-300"
                     x-data="{ isZoomed: false }">
                    <div class="relative group w-full">
                        <!-- Main Image -->
                        <div class="bg-stone-800 rounded-lg p-3 mb-2 relative overflow-hidden group">
                            <div class="w-full h-full">
                                <img src="{{ asset("storage/$card->image") }}" 
                                     alt="{{ $card->card_name }}" 
                                     class="w-full h-[500px] object-contain rounded-lg shadow-lg transform group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <!-- Gradient Overlay on Hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Zoom Icon on Hover -->
                            <button @click="isZoomed = true" 
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-stone-900/80 p-3 rounded-full hover:bg-stone-800/80 transition-colors transform hover:scale-110 duration-200">
                                    <svg class="w-6 h-6 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>

                        <!-- Zoom Modal -->
                        <div x-show="isZoomed" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-90"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-90"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-950/90"
                             @click.self="isZoomed = false">
                            <div class="relative max-w-4xl w-full bg-stone-900 rounded-xl shadow-2xl p-2"
                                 x-data="{ isDragging: false, startX: 0, startY: 0, translateX: 0, translateY: 0, scale: 1, 
                                          resetTransform() { this.translateX = 0; this.translateY = 0; this.scale = 1; } }"
                                 @mousedown="if (scale === 1) { scale = 0.3; } else { resetTransform(); }"
                                 @mousemove.window="if (isDragging) { translateX = $event.clientX - startX; translateY = $event.clientY - startY; }"
                                 @mousedown.stop="isDragging = true; startX = $event.clientX - translateX; startY = $event.clientY - translateY;"
                                 @mouseup.window="isDragging = false"
                                 @wheel.prevent="scale = Math.min(Math.max(0.3, scale + ($event.deltaY > 0 ? -0.05 : 0.05)), 0.6)">
                                <!-- Close Button -->
                                <button @click="isZoomed = false; resetTransform()" 
                                        class="absolute -top-4 -right-4 bg-stone-800 text-stone-200 rounded-full p-2 hover:bg-stone-700 transition-colors focus:outline-none focus:ring-2 focus:ring-stone-600 focus:ring-offset-2 focus:ring-offset-stone-900 z-10">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                
                                <!-- Zoomed Image -->
                                <div class="aspect-w-4 aspect-h-3" :class="{ 'cursor-move': scale < 1, 'cursor-zoom-in': scale === 1 }">
                                    <img src="{{ asset("storage/$card->image") }}" 
                                         alt="{{ $card->card_name }}" 
                                         class="w-full h-full object-contain rounded-lg select-none transition-transform duration-200"
                                         :style="`transform: translate(${translateX}px, ${translateY}px) scale(${scale})`">
                                </div>
                                
                                <!-- Image Details -->
                                <div class="mt-4 px-4 pb-4">
                                    <h3 class="text-xl font-semibold text-stone-50">{{ $card->card_name }}</h3>
                                    <p class="text-stone-400 text-sm mt-1">{{ $card->rarity }} · {{ $card->set_code }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Product Details -->
                <div class="bg-stone-950/80 overflow-hidden shadow-lg rounded-2xl p-8 border border-stone-800/50 backdrop-blur-sm hover:shadow-xl transition-all duration-300">
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-stone-50 mb-2">{{ $card->card_name }}</h1>
                        <p class="text-stone-400 text-sm mb-4">{{ $card->description }}</p>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-2xl font-bold text-amber-500">RM {{ number_format($card->price, 2) }}</span>
                        </div>
                    </div>

                    <!-- Product Specifications -->
                    <div class="mb-8 bg-stone-900/50 rounded-xl p-6 border border-stone-800/30">
                        <div class="flex items-center gap-2 mb-6">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-stone-50">Product Specifications</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-3 px-4 bg-stone-950/50 rounded-lg hover:bg-stone-900/30 transition-colors duration-200 border border-stone-800/30">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-amber-500/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                    <span class="text-stone-300">Rarity</span>
                                </div>
                                <span class="text-stone-50 font-medium">{{ $card->rarity }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 bg-stone-950/50 rounded-lg hover:bg-stone-900/30 transition-colors duration-200 border border-stone-800/30">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-amber-500/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                    </svg>
                                    <span class="text-stone-300">Set</span>
                                </div>
                                <span class="text-stone-50 font-medium">{{ $card->set_code }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 bg-stone-950/50 rounded-lg hover:bg-stone-900/30 transition-colors duration-200 border border-stone-800/30">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-amber-500/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    <span class="text-stone-300">Series</span>
                                </div>
                                <span class="text-stone-50 font-medium">{{ $card->series }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 bg-stone-950/50 rounded-lg hover:bg-stone-900/30 transition-colors duration-200 border border-stone-800/30">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-amber-500/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <span class="text-stone-300">Stock</span>
                                </div>
                                <span class="text-stone-50 font-medium">{{ $card->stock }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @auth
                        @if(auth()->user()->roles === 1)
                            <a href="{{ route('seller.catalogue.edit', $card->id) }}" 
                               class="group flex items-center justify-center gap-2 w-full bg-gradient-to-br from-amber-500 to-amber-700 text-stone-50 py-4 rounded-lg border border-amber-600/50 hover:from-amber-600 hover:to-amber-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-stone-900 font-semibold tracking-wide shadow-lg">
                                <svg class="w-5 h-5 text-amber-100 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Details
                            </a>
                        @elseif(auth()->user()->roles === 0)
                            <!-- Add to Cart Button and Modal -->
                            <div x-data="{ showModal: false }">
                                <button type="button" 
                                        @click="showModal = true"
                                        class="group flex items-center justify-center gap-2 w-full bg-gradient-to-br from-stone-700 via-stone-800 to-stone-900 text-stone-50 py-4 rounded-lg border border-stone-700/50 hover:from-stone-600 hover:via-stone-700 hover:to-stone-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-stone-500 focus:ring-offset-2 focus:ring-offset-stone-900 font-semibold tracking-wide shadow-lg">
                                    <svg class="w-5 h-5 text-stone-200 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Add to Cart
                                </button>

                                <!-- Modal -->
                                <div x-show="showModal" 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-90"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-300"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-90"
                                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-950/95"
                                     @click.self="showModal = false">
                                    
                                    <!-- Modal Content -->
                                    <div class="bg-stone-900 rounded-2xl shadow-2xl p-6 max-w-md w-full border border-stone-800/50 backdrop-blur-sm">
                                        <div class="text-center mb-6">
                                            <h3 class="text-xl font-bold text-stone-50 mb-2">Confirm Add to Cart</h3>
                                            <p class="text-stone-400">Are you sure you want to add {{ $card->card_name }} to your cart?</p>
                                        </div>

                                        <div class="bg-stone-950/50 p-4 rounded-xl mb-6 border border-stone-800/30">
                                            <div class="flex justify-between mb-2">
                                                <span class="text-stone-400">Price:</span>
                                                <span class="text-amber-500 font-semibold">RM {{ $card->price }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-stone-400">Quantity:</span>
                                                <span class="text-stone-50 font-semibold">1</span>
                                            </div>
                                        </div>

                                        <div class="flex gap-4">
                                            <button @click="showModal = false"
                                                    class="flex-1 px-4 py-3 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 transition-colors duration-200 font-medium border border-stone-700/30">
                                                Cancel
                                            </button>
                                            <form action="{{ route('user.cart.store') }}" method="POST" class="flex-1">
                                                @csrf
                                                <input type="hidden" name="card_id" value="{{ $card->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="price" value="{{ $card->price }}">
                                                <button type="submit"
                                                        class="w-full px-4 py-3 bg-gradient-to-br from-stone-700 via-stone-800 to-stone-900 text-stone-50 rounded-lg hover:from-stone-600 hover:via-stone-700 hover:to-stone-800 transition-all duration-200 font-medium border border-stone-700/30">
                                                    Confirm
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- Guest Add to Cart Button -->
                        <div x-data="{ showModal: false }">
                            <button type="button" 
                                    @click="showModal = true"
                                    class="group flex items-center justify-center gap-2 w-full bg-gradient-to-br from-stone-700 via-stone-800 to-stone-900 text-stone-50 py-4 rounded-lg border border-stone-700/50 hover:from-stone-600 hover:via-stone-700 hover:to-stone-800 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-stone-500 focus:ring-offset-2 focus:ring-offset-stone-900 font-semibold tracking-wide shadow-lg">
                                <svg class="w-5 h-5 text-stone-200 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Add to Cart
                            </button>

                            <!-- Modal -->
                            <div x-show="showModal" 
                                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-950/95">
                                
                                <!-- Modal Content -->
                                <div class="bg-stone-900 rounded-2xl shadow-2xl p-6 max-w-md w-full border border-stone-800/50 backdrop-blur-sm">
                                    <div class="text-center mb-6">
                                        <h3 class="text-xl font-bold text-stone-50 mb-2">Login Required</h3>
                                        <p class="text-stone-400">Please login to add items to your cart</p>
                                    </div>

                                    <div class="flex gap-4">
                                        <button @click="showModal = false"
                                                class="flex-1 px-4 py-3 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 transition-colors duration-200 font-medium border border-stone-700/30">
                                            Cancel
                                        </button>
                                        <a href="{{ route('login') }}"
                                           class="flex-1 px-4 py-3 bg-gradient-to-br from-stone-700 via-stone-800 to-stone-900 text-stone-50 rounded-lg hover:from-stone-600 hover:via-stone-700 hover:to-stone-800 transition-all duration-200 text-center font-medium border border-stone-700/30">
                                            Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Ratings & Reviews -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900/90 overflow-hidden shadow-[0_0_10px_rgba(214,211,209,0.1)] rounded-lg p-8 border border-stone-800 backdrop-blur-sm hover:shadow-[0_0_15px_rgba(214,211,209,0.15)] transition-all duration-300">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-6 h-6 text-stone-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-stone-50">Ratings & Reviews</h2>
                </div>

                <div class="text-stone-400">
                    <!-- Ratings & Reviews Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-stone-50">Ratings</h3>
                            <div class="flex items-center gap-2">
                                <div class="flex">
                                    @php
                                        $averageRating = RatingNReview::where('card_id', $card->id)->avg('rating') ?? 0;
                                        $reviewCount = RatingNReview::where('card_id', $card->id)->count();
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-stone-600' }}" 
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-stone-400 text-sm">({{ number_format($averageRating, 1) }} average - {{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})</span>
                            </div>
                        </div>

                        <!-- Rating Distribution Toggle -->
                        <div x-data="{ showDistribution: false }">
                            <button @click="showDistribution = !showDistribution" 
                                    class="w-full flex items-center justify-between p-2 text-stone-400 hover:text-stone-300 transition-colors duration-200 rounded-lg hover:bg-stone-800/50">
                                <span class="text-sm font-medium">View Rating Distribution</span>
                                <svg class="w-5 h-5 transition-transform duration-200" 
                                     :class="{ 'rotate-180': showDistribution }"
                                     fill="none" 
                                     stroke="currentColor" 
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Rating Distribution Content -->
                            <div x-show="showDistribution"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="space-y-2 mt-4">
                                @php
                                    $ratings = RatingNReview::selectRaw('rating, count(*) as count')
                                        ->where('card_id', $card->id)
                                        ->groupBy('rating')
                                        ->orderByDesc('rating')
                                        ->get()
                                        ->pluck('count', 'rating')
                                        ->toArray();
                                @endphp
                                @foreach (range(5, 1) as $rating)
                                    @php
                                        $count = $ratings[$rating] ?? 0;
                                        $percentage = $reviewCount > 0 ? ($count / $reviewCount) * 100 : 0;
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <span class="text-stone-400 text-sm w-12">{{ $rating }} stars</span>
                                        <div class="flex-1 h-2 bg-stone-800 rounded-full overflow-hidden">
                                            <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <span class="text-stone-400 text-sm w-16 text-right">{{ number_format($percentage, 0) }}%</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="space-y-6">
                        <div class="border-t border-stone-800 pt-4">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-stone-50">Reviews</h3>
                            </div>

                            @forelse(RatingNReview::where('card_id', $card->id)->with('user')->latest()->get() as $review)
                                <div class="border-b border-stone-800 pb-4 mb-4 last:border-b-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="text-stone-50 font-medium">
                                                @php
                                                    $name = $review->user->name;
                                                    $length = mb_strlen($name);
                                                    $visibleLength = ceil($length / 2);
                                                    $hiddenPart = str_repeat('*', $length - $visibleLength);
                                                    echo mb_substr($name, 0, $visibleLength) . $hiddenPart;
                                                @endphp
                                            </h4>
                                            <div class="flex items-center gap-2">
                                                <div class="flex">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-stone-600' }}" 
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-stone-500 text-sm">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        @auth
                                            @if(auth()->id() === $review->user_id)
                                                <form action="{{ route('user.review.destroy', $review) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-stone-500 hover:text-stone-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-stone-400 text-sm">{{ $review->review }}</p>
                                </div>
                            @empty
                                <p class="text-stone-400 text-sm text-center py-4">No reviews yet. Be the first to review this card!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Review Modal -->
    @auth
        @if(auth()->user()->roles === 0)
            <x-modal name="write-review" :show="false">
                <form method="POST" action="" class="p-6">
                    @csrf
                    <input type="hidden" name="card_id" value="{{ $card->id }}">
                    
                    <h2 class="text-lg font-medium text-stone-50">
                        Write a Review
                    </h2>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-stone-400">Rating</label>
                        <div class="flex gap-4 mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                    <svg class="w-8 h-8 text-stone-600 peer-checked:text-yellow-400" 
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="review" class="block text-sm font-medium text-stone-400">Review</label>
                        <textarea
                            name="review"
                            id="review"
                            rows="4"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 bg-stone-800 text-stone-50 shadow-sm ring-1 ring-inset ring-stone-700 placeholder:text-stone-500 focus:ring-2 focus:ring-inset focus:ring-stone-600 sm:text-sm sm:leading-6"
                            required
                            maxlength="500"
                            placeholder="Share your thoughts about this card..."
                        ></textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-4">
                        <button type="button" 
                                @click="$dispatch('close')"
                                class="px-4 py-2 bg-stone-800 text-stone-400 rounded-lg hover:bg-stone-700 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-stone-700 to-stone-800 text-stone-50 rounded-lg hover:from-stone-600 hover:to-stone-700 transition-all duration-200">
                            Submit Review
                        </button>
                    </div>
                </form>
            </x-modal>
        @endif
    @endauth
</x-app-layout>