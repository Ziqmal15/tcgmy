<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/x-icon" href="/img/logo2.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TCGMy</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-b from-stone-950 to-stone-900 text-gray-900">
        <div x-data="{ cartOpen: false , isOpen: false }" class="min-h-screen flex flex-col">
            @include('layouts.new-navbar')
            
            {{-- Search Section with Enhanced Backdrop --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-b from-yellow-500/5 to-transparent pointer-events-none"></div>
                <livewire:search-cards />
            </div>
            
            {{-- Featured Section --}}
            <main class="flex-grow py-6">
                <div class="px-6 sm:px-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 lg:gap-8">
                        <!-- Pokemon TCG -->
                        <div class="group relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 to-stone-500/10 rounded-2xl blur-xl transition-all duration-300 group-hover:opacity-75 -z-10"></div>
                            <div class="bg-gradient-to-br from-stone-900/90 to-stone-800/90 overflow-hidden shadow-[0_0_15px_rgba(214,211,209,0.1)] rounded-2xl border border-stone-800/50 backdrop-blur-sm transition-all duration-300 group-hover:border-amber-500/50 group-hover:shadow-amber-500/10">
                                <div class="relative h-[250px] overflow-hidden">
                                    <div class="absolute inset-0 transition-transform duration-500 group-hover:scale-110">
                                        <img src="https://site.pkmn.gg/images/home/homepage-hero.jpg" 
                                             alt="Pokemon TCG" 
                                             class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/80 to-transparent"></div>
                                    </div>
                                    
                                    <div class="relative h-full flex flex-col justify-end p-6">
                                        <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500 mb-2">
                                            Pokemon Trading Card Game
                                        </h2>
                                        <p class="text-stone-300 text-sm mb-4 line-clamp-2 group-hover:text-stone-200 transition-colors">
                                            The Pokémon Trading Card Game is a collectible card game developed by Creatures Inc.
                                        </p>
                                        <a href="{{ route('catalogue.series', 'Pokemon') }}" 
                                           class="inline-block w-fit px-4 py-2 bg-gradient-to-r from-amber-600 to-amber-800 text-stone-50 text-sm font-semibold rounded-xl border border-amber-700/50 hover:from-amber-500 hover:to-amber-700 transition-all duration-300 transform group-hover:scale-105 hover:shadow-lg hover:shadow-amber-500/20">
                                            Explore Collection
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- One Piece TCG -->
                        <div class="group relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 to-stone-500/10 rounded-2xl blur-xl transition-all duration-300 group-hover:opacity-75 -z-10"></div>
                            <div class="bg-gradient-to-br from-stone-900/90 to-stone-800/90 overflow-hidden shadow-[0_0_15px_rgba(214,211,209,0.1)] rounded-2xl border border-stone-800/50 backdrop-blur-sm transition-all duration-300 group-hover:border-amber-500/50 group-hover:shadow-amber-500/10">
                                <div class="relative h-[250px] overflow-hidden">
                                    <div class="absolute inset-0 transition-transform duration-500 group-hover:scale-110">
                                        <img src="https://static1.colliderimages.com/wordpress/wp-content/uploads/2021/11/should-you-watch-one-piece.jpg" 
                                             alt="One Piece TCG" 
                                             class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/80 to-transparent"></div>
                                    </div>
                                    
                                    <div class="relative h-full flex flex-col justify-end p-6">
                                        <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500 mb-2">
                                            One Piece Trading Card Game
                                        </h2>
                                        <p class="text-stone-300 text-sm mb-4 line-clamp-2 group-hover:text-stone-200 transition-colors">
                                            The One Piece Card Game was released by Carddass and licensed by Shueisha.
                                        </p>
                                        <a href="{{ route('catalogue.series', 'One Piece') }}" 
                                           class="inline-block w-fit px-4 py-2 bg-gradient-to-r from-amber-600 to-amber-800 text-stone-50 text-sm font-semibold rounded-xl border border-amber-700/50 hover:from-amber-500 hover:to-amber-700 transition-all duration-300 transform group-hover:scale-105 hover:shadow-lg hover:shadow-amber-500/20">
                                            Explore Collection
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dragon Ball TCG -->
                        <div class="group relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 to-stone-500/10 rounded-2xl blur-xl transition-all duration-300 group-hover:opacity-75 -z-10"></div>
                            <div class="bg-gradient-to-br from-stone-900/90 to-stone-800/90 overflow-hidden shadow-[0_0_15px_rgba(214,211,209,0.1)] rounded-2xl border border-stone-800/50 backdrop-blur-sm transition-all duration-300 group-hover:border-amber-500/50 group-hover:shadow-amber-500/10">
                                <div class="relative h-[250px] overflow-hidden">
                                    <div class="absolute inset-0 transition-transform duration-500 group-hover:scale-110">
                                        <img src="https://alcasthq.com/wp-content/uploads/2024/03/Dragon-Ball-Super-Fusion-World-Best-Decks-and-Card-Lists-DBSFW.jpg" 
                                             alt="Dragon Ball TCG" 
                                             class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/80 to-transparent"></div>
                                    </div>
                                    
                                    <div class="relative h-full flex flex-col justify-end p-6">
                                        <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500 mb-2">
                                            Dragonball FusionWorld Card Game
                                        </h2>
                                        <p class="text-stone-300 text-sm mb-4 line-clamp-2 group-hover:text-stone-200 transition-colors">
                                            The Dragon Ball Super Card Game is an exciting trading card game.
                                        </p>
                                        <a href="{{ route('catalogue.series', 'Dragon Ball') }}" 
                                           class="inline-block w-fit px-4 py-2 bg-gradient-to-r from-amber-600 to-amber-800 text-stone-50 text-sm font-semibold rounded-xl border border-amber-700/50 hover:from-amber-500 hover:to-amber-700 transition-all duration-300 transform group-hover:scale-105 hover:shadow-lg hover:shadow-amber-500/20">
                                            Explore Collection
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Catalogues Section --}}
                <div class="relative mt-12 mx-6 sm:mx-8">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-500/5 via-stone-500/5 to-amber-500/5 rounded-2xl blur-xl"></div>
                    <div class="relative pt-8 pb-12 flex flex-col justify-center items-center bg-gradient-to-br from-stone-900/90 to-stone-800/90 rounded-2xl shadow-xl border border-stone-800/50 backdrop-blur-sm">
                        <h3 class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500 text-3xl font-bold mb-10">Featured Cards</h3>
                        <div class="w-full flex flex-wrap px-6 py-4 gap-x-8 gap-y-10 justify-center">
                            @if ($cards->count() > 0)
                                @foreach ($cards as $card)
                                    <x-home-catalogue-card 
                                        :link="route('catalogue.show', $card->id)"
                                        :title="$card->card_name" 
                                        :image="$card->image" 
                                        :price="$card->price"
                                        :rarity="$card->rarity" 
                                        :stock="$card->stock" 
                                        :series="$card->series" 
                                        :set="$card->set_code" 
                                    />
                                @endforeach
                            @else
                                <div class="p-8 text-stone-400 text-lg">
                                    {{ __("No product found!") }}
                                </div>
                            @endif
                        </div>
                        <div class="mt-12 px-6 w-full">
                            {{ $cards->links() }}
                        </div>
                    </div>
                </div>
            </main>

            {{-- Enhanced Footer with Modern Design --}}
            <footer class="relative mt-12 bg-gradient-to-b from-stone-900 via-stone-900 to-stone-950">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500/5 via-transparent to-amber-500/5 pointer-events-none"></div>
                
                <!-- Top Border Gradient -->
                <div class="h-px bg-gradient-to-r from-transparent via-amber-500/20 to-transparent"></div>
                
                <div class="relative container mx-auto px-6 lg:px-8">
                    <!-- Main Footer Content -->
                    <div class="py-12">
                        <!-- Connect Section -->
                        <div class="flex flex-col items-center justify-center mb-12">
                            <div class="inline-flex items-center gap-3 mb-8">
                                <img src="/img/logo2.png" alt="TCGMy Logo" class="w-10 h-10 rounded-lg">
                                <h3 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500">
                                    Connect With Us
                                </h3>
                            </div>
                            
                            <!-- Social Links Grid -->
                            <div class="grid grid-flow-col gap-8">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/share/15rSFkG1Wg/?mibextid=wwXIfr" 
                                   class="group relative">
                                    <div class="absolute inset-0 bg-amber-500/20 rounded-xl blur-xl transition-opacity duration-300 opacity-0 group-hover:opacity-100"></div>
                                    <div class="relative flex items-center justify-center w-12 h-12 rounded-xl bg-stone-800/50 border border-stone-700/30 backdrop-blur-sm transition-all duration-300 group-hover:border-amber-500/50 group-hover:bg-stone-800/80 group-hover:scale-110">
                                        <svg class="w-6 h-6 text-stone-400 transition-colors duration-300 group-hover:text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                        </svg>
                                    </div>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://wa.link/1oizdy" 
                                   class="group relative">
                                    <div class="absolute inset-0 bg-amber-500/20 rounded-xl blur-xl transition-opacity duration-300 opacity-0 group-hover:opacity-100"></div>
                                    <div class="relative flex items-center justify-center w-12 h-12 rounded-xl bg-stone-800/50 border border-stone-700/30 backdrop-blur-sm transition-all duration-300 group-hover:border-amber-500/50 group-hover:bg-stone-800/80 group-hover:scale-110">
                                        <svg class="w-6 h-6 text-stone-400 transition-colors duration-300 group-hover:text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                    </div>
                                </a>

                                <!-- TikTok -->
                                <a href="https://www.tiktok.com/@onetcgcentre?_t=ZM-8t7QXLSYKUY&_r=1" 
                                   class="group relative">
                                    <div class="absolute inset-0 bg-amber-500/20 rounded-xl blur-xl transition-opacity duration-300 opacity-0 group-hover:opacity-100"></div>
                                    <div class="relative flex items-center justify-center w-12 h-12 rounded-xl bg-stone-800/50 border border-stone-700/30 backdrop-blur-sm transition-all duration-300 group-hover:border-amber-500/50 group-hover:bg-stone-800/80 group-hover:scale-110">
                                        <svg class="w-6 h-6 text-stone-400 transition-colors duration-300 group-hover:text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Section with Gradient Border -->
                    <div class="relative">
                        <div class="h-px bg-gradient-to-r from-transparent via-stone-700/50 to-transparent"></div>
                        <div class="py-8">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                                <div class="flex items-center gap-3">
                                    <img src="/img/logo2.png" alt="TCGMy Logo" class="w-8 h-8 rounded-lg opacity-80">
                                    <p class="text-sm text-stone-400">
                                        &copy; {{ date('Y') }} <span class="text-stone-300">TCGMy</span> by OneTCGCentre. All rights reserved.
                                    </p>
                                </div>
                                <div class="flex items-center gap-8">
                                    <a href="#" class="text-sm text-stone-400 hover:text-amber-500 transition-all duration-300 hover:translate-y-[-2px]">
                                        Privacy Policy
                                    </a>
                                    <div class="h-4 w-px bg-stone-700/50"></div>
                                    <a href="#" class="text-sm text-stone-400 hover:text-amber-500 transition-all duration-300 hover:translate-y-[-2px]">
                                        Terms of Service
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
