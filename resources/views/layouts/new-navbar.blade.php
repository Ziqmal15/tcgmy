<div x-data="{ mobileMenuOpen: false, showLogoutModal: false, logoutModal: true }" @keydown.escape.window="showLogoutModal = false">
    <header class="relative">
        <div class="mx-0 justify-center">
            <!-- Top Navigation Bar -->
            <div class="bg-[#111111] flex items-center justify-between py-4 px-6 border-b border-[#2c2c2c] shadow-lg">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <img src='/img/logo2.png' class="w-12 h-12 transform transition-transform duration-300 group-hover:scale-110" alt="Logo"/>
                        <div class="text-white text-2xl font-bold ms-3 group-hover:text-[#d4af37] transition-colors duration-300">
                            TCGMy
                            <div class="text-xs font-medium text-gray-400 group-hover:text-[#d4af37] transition-colors duration-300">
                                <span>by ONETCGCentre</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Main Navigation -->
                <div class="hidden md:flex items-center space-x-10">
                    @auth
                        @if (Auth::user()->roles === 0)
                            <a href="{{ route('home') }}" 
                                class="text-white hover:text-[#d4af37] transition-all duration-300 relative group {{ request()->routeIs('home') ? 'text-[#d4af37] font-bold' : '' }}">
                                Home
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#d4af37] transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="{{ route('catalogue') }}" 
                               class="text-white hover:text-[#d4af37] transition-all duration-300 relative group {{ request()->routeIs('catalogue') ? 'text-[#d4af37] font-bold' : '' }}">
                                Shop
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#d4af37] transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="{{ route('company') }}" 
                               class="text-white hover:text-[#d4af37] transition-all duration-300 relative group {{ request()->routeIs('catalogue') ? 'text-[#d4af37] font-bold' : '' }}">
                                About Us
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#d4af37] transition-all duration-300 group-hover:w-full"></span>
                            </a>
                        @endif

                        @if (Auth::user()->roles === 1)
                            <a href="{{ route('seller.catalogue.index') }}" 
                               class="text-white hover:text-[#d4af37] transition-all duration-300 relative group {{ request()->routeIs('seller.catalogue.index') ? 'text-[#d4af37] font-bold' : '' }}">
                                Product Management
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#d4af37] transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="{{ route('seller.order.index') }}" 
                               class="text-white hover:text-[#d4af37] transition-all duration-300 relative group {{ request()->routeIs('order.index') ? 'text-[#d4af37] font-bold' : '' }}">
                                Product Order
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#d4af37] transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="{{ route('seller.coupons.index') }}" 
                               class="text-white hover:text-[#d4af37] transition-all duration-300 relative group {{ request()->routeIs('catalogue') ? 'text-[#d4af37] font-bold' : '' }}">
                                Coupon Management
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#d4af37] transition-all duration-300 group-hover:w-full"></span>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('catalogue') }}" 
                           class="text-white hover:text-[#d4af37] transition-all duration-300 relative group {{ request()->routeIs('catalogue') ? 'text-[#d4af37] font-bold' : '' }}">
                            Shop
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#d4af37] transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    @endauth
                </div>

                <!-- Right Icons Section -->
                <div class="flex items-center space-x-8">
                    
                    @auth
                        @if (Auth::user()->roles === 0)
                            <!-- Coupon Icon -->
                            <a href="{{ route('user.coupon.index') }}" class="relative text-white hover:text-[#d4af37] transition-all duration-300 group">
                                <svg class="w-6 h-6 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </a>
                            
                            <!-- Cart Icon with Counter -->
                            <a href="{{ route('user.cart.index') }}" class="relative text-white hover:text-[#d4af37] transition-all duration-300 group">
                                <svg class="w-6 h-6 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </a>
                        @endif

                        <!-- User Account Section -->
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="right" width="48" contentClasses="bg-[#111111] border border-[#2c2c2c] text-white shadow-xl rounded-lg overflow-hidden">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white hover:text-[#d4af37] transition-all duration-300 rounded-lg hover:bg-[#1a1a1a]">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-2">
                                            <svg class="fill-current h-4 w-4 transition-transform duration-300 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">

                                    @if (Auth::user()->roles === 0)
                                        <x-dropdown-link :href="route('dashboard')"
                                            class="text-white hover:bg-[#2c2c2c] hover:text-[#d4af37]">
                                            {{ __('Dashboard') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link
                                            @click="showLogoutModal = true"
                                            class="text-white hover:bg-[#2c2c2c] hover:text-[#d4af37] cursor-pointer">
                                            {{ __('Logout') }}
                                        </x-dropdown-link>
                                       
                                    @endif

                                    @if (Auth::user()->roles === 1)
                                        <x-dropdown-link :href="route('seller.dashboard')"
                                            class="text-white hover:bg-[#2c2c2c] hover:text-[#d4af37]">
                                            {{ __('My Dashboard') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link
                                            @click="showLogoutModal = true"
                                            class="text-white hover:bg-[#2c2c2c] hover:text-[#d4af37] cursor-pointer">
                                            {{ __('Logout') }}
                                        </x-dropdown-link>
                                    @endif

                                    @if (Auth::user()->roles === 2)
                                        <x-dropdown-link :href="route('admin.dashboard')"
                                            class="text-white hover:bg-[#2c2c2c] hover:text-[#d4af37]">
                                            {{ __('My Dashboard') }}
                                        </x-dropdown-link>
                                    @endif

                                        
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-white hover:text-[#d4af37] transition-colors duration-200">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="text-white hover:text-[#d4af37] transition-colors duration-200">
                                Register
                            </a>
                        @endif
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden text-white hover:text-[#d4af37] focus:outline-none transition-colors duration-300"
                        aria-label="Toggle menu"
                    >
                        <svg 
                            class="w-7 h-7" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path 
                                :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }"
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                @click.away="mobileMenuOpen = false"
                class="absolute top-full left-0 right-0 w-full md:hidden bg-[#111111] border-b border-[#2c2c2c] shadow-xl z-50"
                x-cloak
            >
                <div class="px-6 py-4 space-y-4">
                    <a href="{{ route('home') }}" 
                       class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2 {{ request()->routeIs('home') ? 'text-[#d4af37] font-bold' : '' }}">
                        Home
                    </a>
                    
                    @auth
                        @if (Auth::user()->roles === 0)
                            <a href="{{ route('catalogue') }}" 
                               class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2 {{ request()->routeIs('catalogue') ? 'text-[#d4af37] font-bold' : '' }}">
                                Shop
                            </a>
                            <a href="{{ route('user.coupon.index') }}" 
                               class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2 {{ request()->routeIs('user.coupon.index') ? 'text-[#d4af37] font-bold' : '' }}">
                                My Coupons
                            </a>
                            <a href="{{ route('user.cart.index') }}" 
                               class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2 {{ request()->routeIs('user.cart.index') ? 'text-[#d4af37] font-bold' : '' }}">
                                My Cart
                            </a>
                            <a href="#" 
                               class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2">
                                My Orders
                            </a>
                        @endif

                        @if (Auth::user()->roles === 1)
                            <a href="{{ route('seller.catalogue.index') }}" 
                               class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2 {{ request()->routeIs('seller.catalogue.index') ? 'text-[#d4af37] font-bold' : '' }}">
                                Product Management
                            </a>
                            <a href="#" 
                               class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2">
                                Product Order
                            </a>
                        @endif

                        <!-- Profile Link -->
                        <a href="{{ route('profile.edit') }}" 
                           class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2">
                            Profile
                        </a>
                        
                        <!-- Logout Link -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="button" 
                                @click="showLogoutModal = true"
                                class="w-full text-left text-white hover:text-[#d4af37] transition-all duration-300 py-2"
                            >
                                Log Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('catalogue') }}" 
                           class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2 {{ request()->routeIs('catalogue') ? 'text-[#d4af37] font-bold' : '' }}">
                            Shop
                        </a>
                        <a href="{{ route('login') }}" 
                           class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="block text-white hover:text-[#d4af37] transition-all duration-300 py-2">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Logout Modal -->
    <div>
        <!-- Modal Backdrop -->
        <div x-show="showLogoutModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm z-50"
             @click="showLogoutModal = false">
        </div>

        <!-- Modal Content -->
        <div x-show="showLogoutModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             @click.away="showLogoutModal = false">
            
            <div class="bg-[#111111] border border-[#2c2c2c] rounded-xl p-8 w-96 max-w-md mx-auto shadow-2xl">
                <div class="flex flex-col" x-show="logoutModal">
                    <h3 class="text-2xl font-bold text-white mb-4">Confirm Logout</h3>
                    <p class="text-gray-300 mb-8">Are you sure you want to logout from your account?</p>
                    
                    <div class="flex justify-end space-x-4">
                        <button @click="showLogoutModal = false"
                                class="px-6 py-2.5 text-white hover:text-[#d4af37] transition-all duration-300 rounded-lg border border-[#2c2c2c] hover:border-[#d4af37]">
                            Cancel
                        </button>
                        <button 
                            type="submit"
                            @click="logoutModal = false"
                            class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105"
                        >
                            Logout
                        </button>
                    </div>
                </div>
            
                <div class="flex flex-col text-center mb-8" x-show="!logoutModal">
                    <h3 class="text-2xl font-bold text-white mb-3">We'd Love Your Feedback!</h3>
                    <p class="text-gray-400">Your opinion helps us improve our service</p>
                </div>
                
                <div class="flex justify-end space-x-3" x-show="!logoutModal">
                    <form method="POST" action="{{ route('feedback.store') }}" class="w-full" x-data="{ rating: 0, hoverRating: 0 }">
                        @csrf
                        
                        <!-- Star Rating -->
                        <div class="mb-8">
                            <label class="block text-white text-lg mb-4 text-center">How was your experience?</label>
                            <div class="flex items-center justify-center space-x-3">
                                <template x-for="i in 5">
                                    <button 
                                        type="button"
                                        @click="rating = i"
                                        @mouseover="hoverRating = i"
                                        @mouseleave="hoverRating = 0"
                                        :class="{ 
                                            'text-[#d4af37] scale-125': rating >= i || hoverRating >= i,
                                            'text-[#2c2c2c]': rating < i && hoverRating < i,
                                            'hover:scale-125': true
                                        }"
                                        class="text-4xl focus:outline-none transform transition-all duration-300 ease-out"
                                    >
                                        <span class="hover:animate-pulse">★</span>
                                    </button>
                                </template>
                                <input type="hidden" name="rating" :value="rating">
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-400 mt-3" 
                                   x-text="rating ? `You rated us ${rating} star${rating > 1 ? 's' : ''}` : 'Click to rate'"
                                   :class="{'text-[#d4af37]': rating > 0}">
                                </p>
                                <div class="text-xs text-gray-500 mt-1" x-show="hoverRating > 0">
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

                        <!-- Comment Box -->
                        <div class="mb-8 transform transition-all duration-300" :class="{'translate-y-0 opacity-100': rating > 0, 'translate-y-4 opacity-0': !rating}">
                            <label for="comment" class="block text-white text-lg mb-3 text-center">Share your thoughts with us</label>
                            <div class="relative">
                                <textarea 
                                    id="comment" 
                                    name="comment" 
                                    rows="3" 
                                    placeholder="Tell us what you think..."
                                    class="w-full bg-[#1a1a1a] border-2 border-[#2c2c2c] rounded-xl text-white p-4 focus:border-[#d4af37] focus:ring-2 focus:ring-[#d4af37] focus:ring-opacity-50 transition-all duration-300 placeholder-gray-600"
                                ></textarea>
                                <div class="absolute bottom-3 right-3 text-gray-600 text-sm">Optional</div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-center space-x-4">
                            <button type="button" 
                                @click="document.querySelector('form[action=\'{{ route('logout') }}\']').submit()"
                                class="px-6 py-2.5 text-gray-400 hover:text-white transition-all duration-300 rounded-lg border border-transparent hover:border-[#2c2c2c]">
                                Skip Feedback
                            </button>
                            <button type="submit"
                                class="px-8 py-2.5 bg-gradient-to-r from-[#d4af37] to-[#b7952f] text-white rounded-lg hover:from-[#b7952f] hover:to-[#96791f] transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 shadow-lg"
                                :disabled="!rating"
                            >
                                Submit Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>