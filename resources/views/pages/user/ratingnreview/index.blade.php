<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Rate & Review
        </h2>
    </x-slot>

    <div class="py-12 bg-[#111111] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-b from-[#1a1a1a] to-[#111111] border border-[#2c2c2c] overflow-hidden shadow-2xl sm:rounded-2xl backdrop-blur-sm">
                <div class="p-8">
                    <form method="POST" action="{{ route('user.review.store') }}" class="space-y-6" x-data="{ rating: 0, hoverRating: 0 }">
                        @csrf
                        <input type="hidden" name="card_id" value="{{ $card->id }}">
                        
                        <!-- Card Information -->
                        <div class="mb-10">
                            <div class="flex flex-col items-center space-y-6">
                                <div class="relative group">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-[#d4af37] to-[#b7952f] rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                                    <img src="{{ asset("storage/$card->image") }}" alt="{{ $card->card_name }}" class="relative w-56 h-56 object-cover rounded-lg shadow-2xl transform transition duration-500 hover:scale-105">
                                </div>
                                <div class="text-center">
                                    <h3 class="text-2xl font-bold text-white bg-clip-text text-transparent bg-gradient-to-r from-[#d4af37] to-[#b7952f]">{{ $card->card_name }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Star Rating -->
                        <div class="mb-10">
                            <label class="block text-white text-xl mb-4 text-center font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#d4af37] to-[#b7952f]">How would you rate this card?</label>
                            <div class="flex items-center justify-center space-x-3">
                                <template x-for="i in 5">
                                    <button 
                                        type="button"
                                        @click="rating = i"
                                        @mouseover="hoverRating = i"
                                        @mouseleave="hoverRating = 0"
                                        :class="{ 
                                            'text-[#d4af37] scale-125 rotate-[360deg]': rating >= i || hoverRating >= i,
                                            'text-[#2c2c2c]': rating < i && hoverRating < i,
                                            'hover:scale-125': true
                                        }"
                                        class="text-5xl focus:outline-none transform transition-all duration-500 ease-out hover:rotate-[360deg]"
                                    >
                                        <span class="hover:animate-pulse">★</span>
                                    </button>
                                </template>
                                <input type="hidden" name="rating" :value="rating">
                            </div>
                            <div class="text-center mt-4">
                                <p class="text-md text-stone-400" 
                                   x-text="rating ? `You rated this card ${rating} star${rating > 1 ? 's' : ''}` : 'Click to rate'"
                                   :class="{'text-[#d4af37] font-semibold': rating > 0}">
                                </p>
                                <div class="text-sm text-stone-500 mt-2" x-show="hoverRating > 0" x-transition>
                                    <span x-text="[
                                        'Poor',
                                        'Fair',
                                        'Good',
                                        'Very Good',
                                        'Excellent'
                                    ][hoverRating - 1]"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Review Text -->
                        <div class="mb-10 transform transition-all duration-500" :class="{'translate-y-0 opacity-100': rating > 0, 'translate-y-4 opacity-0': !rating}">
                            <label class="block text-white text-xl mb-4 text-center font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#d4af37] to-[#b7952f]">Share your thoughts about this card</label>
                            <div class="relative group">
                                <div class="absolute -inset-1 bg-gradient-to-r from-[#d4af37] to-[#b7952f] rounded-xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                                <textarea
                                    id="review"
                                    name="review"
                                    rows="4"
                                    placeholder="Tell us what you think about this card..."
                                    class="relative w-full bg-[#1a1a1a] border-2 border-[#2c2c2c] rounded-xl text-white p-4 focus:border-[#d4af37] focus:ring-2 focus:ring-[#d4af37] focus:ring-opacity-50 transition-all duration-300 placeholder-stone-600 resize-none"
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center">
                            <button
                                type="submit"
                                class="relative px-10 py-3 bg-gradient-to-r from-[#d4af37] to-[#b7952f] text-white rounded-xl hover:from-[#b7952f] hover:to-[#96791f] transition-all duration-500 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 font-bold text-lg shadow-xl overflow-hidden group"
                                :disabled="!rating"
                            >
                                <span class="absolute w-64 h-64 mt-12 group-hover:-rotate-45 group-hover:-mt-24 transition-all duration-1000 ease-out -left-10 bg-gradient-to-r from-white/20 to-transparent opacity-10 group-hover:opacity-20"></span>
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Display Reviews Section -->
            <div class="mt-8 bg-gradient-to-b from-[#1a1a1a] to-[#111111] border border-[#2c2c2c] overflow-hidden shadow-2xl sm:rounded-2xl backdrop-blur-sm">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-center bg-clip-text text-transparent bg-gradient-to-r from-[#d4af37] to-[#b7952f] mb-8">Customer Reviews</h3>
                    
                    @forelse ($reviews as $review)
                        <div class="border-b border-[#2c2c2c] py-6 last:border-b-0 hover:bg-[#1a1a1a] transition-all duration-300 px-4 rounded-xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <span class="text-[#d4af37] text-2xl tracking-wider">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                ★
                                            @else
                                                <span class="text-[#2c2c2c]">☆</span>
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-stone-300 font-semibold text-lg">{{ $review->user->name }}</span>
                                </div>
                                <span class="text-sm text-stone-500 italic">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-stone-400 ml-1 leading-relaxed">{{ $review->review }}</p>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-stone-500 text-lg">No reviews yet. Be the first to review this card!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
