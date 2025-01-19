<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Coupon') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen bg-gradient-to-b from-stone-900 to-stone-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-stone-800/80 to-stone-900/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-2xl border border-stone-700/30">
                <div class="p-8">
                    <!-- Your Coupons Section -->
                    <div class="mb-12">
                        <div class="flex items-center gap-3 mb-8">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-yellow-200 to-yellow-500 text-transparent bg-clip-text">Your Coupons</h1>
                        </div>
                        <div class="grid grid-cols-1 gap-8">
                            @forelse ($userCoupons as $coupon)
                                <div class="group relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/10 to-stone-500/10 rounded-2xl blur-xl transition-all duration-300 group-hover:opacity-75 -z-10"></div>
                                    <div class="bg-gradient-to-br from-stone-800/90 to-stone-900/90 rounded-2xl p-6 border border-stone-700/50 hover:border-yellow-500/50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-yellow-500/10">
                                        <div class="flex justify-between items-start gap-6">
                                            <div class="flex-grow">
                                                <div class="flex items-center gap-4 mb-4">
                                                    <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">{{ $coupon->coupon->code }}</span>
                                                    <span class="bg-{{ $coupon->coupon->type === 'registration' ? 'yellow' : ($coupon->coupon->type === 'birthday' ? 'pink' : 'green') }}-500/20 
                                                           text-{{ $coupon->coupon->type === 'registration' ? 'yellow' : ($coupon->coupon->type === 'birthday' ? 'pink' : 'green') }}-300 
                                                           text-xs px-4 py-1.5 rounded-full border 
                                                           border-{{ $coupon->coupon->type === 'registration' ? 'yellow' : ($coupon->coupon->type === 'birthday' ? 'pink' : 'green') }}-500/30
                                                           backdrop-blur-sm">
                                                        {{ ucfirst($coupon->coupon->type) }}
                                                    </span>
                                                </div>
                                                <div class="space-y-3">
                                                    <p class="text-stone-300 text-lg">{{ $coupon->coupon->description }}</p>
                                                    <div class="flex flex-wrap items-center gap-6 text-sm text-stone-400">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span>Valid until: {{ $coupon->coupon->valid_until->format('M d, Y') }}</span>
                                                        </div>
                                                        @if($coupon->coupon->min_spend > 0)
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                            </svg>
                                                            <span>Min. spend RM{{ number_format($coupon->coupon->min_spend, 2) }}</span>
                                                        </div>
                                                        @endif
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span class="font-medium">
                                                                {{ $coupon->coupon->discount_type === 'percentage' ? 
                                                                    $coupon->coupon->discount_amount . '% OFF' : 
                                                                    'RM' . number_format($coupon->coupon->discount_amount, 2) . ' OFF' 
                                                                }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-col gap-3">
                                                @if($coupon->is_used)
                                                    <div class="bg-stone-900/80 text-stone-500 px-6 py-3 rounded-xl text-sm flex items-center justify-center gap-2 min-w-[140px] cursor-not-allowed backdrop-blur-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span>Used</span>
                                                    </div>
                                                @else
                                                    <button id="copy-button-{{ $coupon->coupon->id }}" onclick="copyCouponCode('{{ $coupon->coupon->code }}', this)" 
                                                            class="bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-500 hover:to-yellow-600 text-yellow-100 px-6 py-3 rounded-xl text-sm transition-all duration-300 flex items-center justify-center gap-2 min-w-[140px] transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-yellow-500/20">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                        </svg>
                                                        <span id="copy-text-{{ $coupon->coupon->id }}">Copy Code</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 bg-stone-900/50 rounded-2xl border border-stone-800">
                                    <svg class="w-16 h-16 mx-auto text-stone-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-stone-400 text-lg">No coupons available at the moment.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Available Auto-Assign Coupons Section -->
                    @if($potentialCoupons->isNotEmpty())
                        <div class="mt-16">
                            <div class="flex items-center gap-3 mb-8">
                                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-300 to-blue-500 text-transparent bg-clip-text">Coupons You Can Earn</h2>
                            </div>
                            <div class="grid grid-cols-1 gap-8">
                                @foreach($potentialCoupons as $coupon)
                                    <div class="group relative">
                                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-stone-500/10 rounded-2xl blur-xl transition-all duration-300 group-hover:opacity-75 -z-10"></div>
                                        <div class="bg-gradient-to-br from-stone-900/90 to-stone-800/90 rounded-2xl p-6 border border-stone-800/50 hover:border-blue-500/50 transition-all duration-300 backdrop-blur-sm">
                                            <div class="flex justify-between items-start gap-6">
                                                <div class="flex-grow">
                                                    <div class="flex items-center gap-4 mb-4">
                                                        <span class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-blue-500">{{ $coupon->code }}</span>
                                                        <span class="bg-blue-500/20 text-blue-300 text-xs px-4 py-1.5 rounded-full border border-blue-500/30 backdrop-blur-sm">
                                                            Auto-Assign
                                                        </span>
                                                    </div>
                                                    <div class="space-y-3">
                                                        <p class="text-stone-300 text-lg">{{ $coupon->description }}</p>
                                                        <div class="flex flex-wrap items-center gap-6 text-sm text-stone-400">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                                </svg>
                                                                <span>Complete an order over RM{{ number_format($coupon->auto_assign_threshold, 2) }}</span>
                                                            </div>
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span class="font-medium">
                                                                    {{ $coupon->discount_type === 'percentage' ? 
                                                                        $coupon->discount_amount . '% OFF' : 
                                                                        'RM' . number_format($coupon->discount_amount, 2) . ' OFF' 
                                                                    }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyCouponCode(code, button) {
            const copyText = button.querySelector('span');
            navigator.clipboard.writeText(code).then(() => {
                copyText.textContent = 'Copied!';
                button.classList.add('bg-green-600', 'hover:bg-green-700');
                button.classList.remove('from-yellow-600', 'to-yellow-700', 'hover:from-yellow-500', 'hover:to-yellow-600');
                setTimeout(() => {
                    copyText.textContent = 'Copy Code';
                    button.classList.remove('bg-green-600', 'hover:bg-green-700');
                    button.classList.add('from-yellow-600', 'to-yellow-700', 'hover:from-yellow-500', 'hover:to-yellow-600');
                }, 2000);
            });
        }
    </script>
    @endpush
</x-app-layout>
