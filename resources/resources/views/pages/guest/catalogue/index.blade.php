<link rel="icon" type="image/x-icon" href="/img/logo2.png">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Catalogue') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enhanced Container with Gradient Effects -->
            <div class="relative">
                <!-- Background Gradient Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500/5 via-stone-500/5 to-amber-500/5 rounded-2xl blur-xl"></div>
                
                <!-- Main Content Container -->
                <div class="relative bg-gradient-to-br from-stone-900/90 to-stone-800/90 p-8 rounded-2xl shadow-xl border border-stone-800/50 backdrop-blur-sm">
                    <!-- Header Section with Enhanced Design -->
                    <div class="flex justify-between items-center mb-8">
                        <div class="w-full flex flex-col items-center space-y-2">
                            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500">
                                {{ __('Trading Card Collection') }}
                            </h1>
                            <p class="text-stone-400 text-sm">Discover our extensive collection of trading cards</p>
                        </div>
                    </div>

                    <!-- Enhanced Search Section -->
                    <div class="mb-8 transform transition-all duration-300 hover:scale-[1.01]">
                        <livewire:search-cards />
                    </div>

                    <!-- Cards Grid with Enhanced Styling -->
                    <div class="w-full">
                        <div class="flex flex-wrap gap-8 justify-center">
                            @foreach($cards as $card)
                                <x-home-catalogue-card 
                                    :link="route('catalogue.show', $card->id)"
                                    :title="$card->card_name"
                                    :price="$card->price"
                                    :image="$card->image"
                                    :stock="$card->stock"
                                    :rarity="$card->rarity"
                                    :set="$card->set_code"
                                    :series="$card->series"
                                />
                            @endforeach
                        </div>
                    </div>

                    <!-- Enhanced Pagination -->
                    <div class="mt-10">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-amber-500/10 to-transparent blur-sm"></div>
                            <div class="relative">
                                {{ $cards->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
