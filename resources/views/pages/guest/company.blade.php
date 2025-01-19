<x-app-layout>
    <div class="bg-stone-900">
        <!-- Hero Section -->
        <div class="relative h-[500px] overflow-hidden">
            <img src="{{ asset('img/img3.jpg') }}" alt="TCGMy Office" class="w-full h-full object-cover scale-105 transform hover:scale-100 transition-transform duration-700 opacity-90">
            <div class="absolute inset-0 bg-gradient-to-b from-stone-900/70 via-stone-900/60 to-stone-900/90 flex items-center justify-center">
                <div class="text-center max-w-4xl px-4 animate-fade-in bg-stone-900/40 rounded-xl p-8">
                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 tracking-tight">About <span class="text-[#d4af37]">TCGMy</span></h1>
                    <p class="text-xl md:text-2xl text-stone-200 font-light">Your Trusted Partner in Trading Card Games</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-[#d4af37] to-[#b39030] mx-auto mt-8"></div>
                </div>
            </div>
        </div>

        <!-- Company Introduction -->
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="space-y-6">
                    <h2 class="text-4xl font-bold text-white mb-8 relative">
                        Our Story
                        <span class="absolute bottom-0 left-0 w-20 h-1 bg-gradient-to-r from-[#d4af37] to-[#b39030]"></span>
                    </h2>
                    <p class="text-lg text-stone-300 leading-relaxed">
                        Founded with passion and dedication, TCGMy has grown to become Malaysia's premier destination for trading card game enthusiasts. Our journey began with a simple mission: to create a trusted platform where collectors and players can find authentic cards and build meaningful connections within the TCG community.
                    </p>
                    <p class="text-lg text-stone-300 leading-relaxed">
                        Today, we pride ourselves on offering a carefully curated selection of cards, exceptional customer service, and a commitment to fostering the growth of the TCG community in Malaysia.
                    </p>
                </div>
                <div class="space-y-8">
                    <div class="bg-gradient-to-br from-stone-800 to-stone-900 p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-stone-700 hover:border-[#d4af37]/30">
                        <h3 class="text-2xl font-semibold text-white mb-4 flex items-center">
                            <span class="text-[#d4af37] mr-3"><i class="fas fa-star"></i></span>
                            Our Mission
                        </h3>
                        <p class="text-stone-300 leading-relaxed">To provide authentic trading cards and create a trusted marketplace where enthusiasts can safely trade and collect their favorite cards.</p>
                    </div>
                    <div class="bg-gradient-to-br from-stone-800 to-stone-900 p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-stone-700 hover:border-[#d4af37]/30">
                        <h3 class="text-2xl font-semibold text-white mb-4 flex items-center">
                            <span class="text-[#d4af37] mr-3"><i class="fas fa-eye"></i></span>
                            Our Vision
                        </h3>
                        <p class="text-stone-300 leading-relaxed">To become the leading trading card platform in Malaysia, known for authenticity, reliability, and community engagement.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-gradient-to-b from-stone-900 via-stone-800 to-stone-900 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-bold text-center text-white mb-16 relative inline-block">
                    Why Choose TCGMy
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-[#d4af37] to-[#b39030]"></span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="bg-gradient-to-br from-stone-800 to-stone-900 p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-stone-700 hover:border-[#d4af37]/30">
                        <div class="text-[#d4af37] text-3xl mb-6">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">Authenticity Guaranteed</h3>
                        <p class="text-stone-300 leading-relaxed">Every card in our inventory is thoroughly verified for authenticity, ensuring you receive genuine products.</p>
                    </div>
                    <div class="bg-gradient-to-br from-stone-800 to-stone-900 p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-stone-700 hover:border-[#d4af37]/30">
                        <div class="text-[#d4af37] text-3xl mb-6">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">Fast & Secure Shipping</h3>
                        <p class="text-stone-300 leading-relaxed">Your purchases are carefully packed and promptly delivered to your doorstep with tracking provided.</p>
                    </div>
                    <div class="bg-gradient-to-br from-stone-800 to-stone-900 p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-stone-700 hover:border-[#d4af37]/30">
                        <div class="text-[#d4af37] text-3xl mb-6">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">Community First</h3>
                        <p class="text-stone-300 leading-relaxed">We're built by collectors for collectors, fostering a vibrant and engaging TCG community.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-4xl font-bold text-white mb-8">Get in Touch</h2>
                <p class="text-xl text-stone-300 mb-10">Have questions or need assistance? Our team is here to help!</p>
                <div class="space-x-4">
                    <a href="mailto:contact@tcgmy.com" class="inline-block bg-gradient-to-r from-[#d4af37] to-[#b39030] text-white px-8 py-4 rounded-lg hover:from-[#b39030] hover:to-[#906f20] transition-all duration-300 shadow-lg hover:shadow-xl text-lg">
                        <i class="fas fa-envelope mr-2"></i> Contact Us
                    </a>
                    <a href="#" class="inline-block border-2 border-[#d4af37] text-[#d4af37] px-8 py-4 rounded-lg hover:bg-[#d4af37] hover:text-stone-900 transition-all duration-300 shadow-lg hover:shadow-xl text-lg">
                        <i class="fas fa-phone mr-2"></i> Call Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }
    </style>
</x-app-layout> 