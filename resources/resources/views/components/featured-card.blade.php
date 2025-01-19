@props([
    'href' => '#',
    'title' => 'Pokemon Trading Card Game',
    'bgimage' => '/img/card/blaster-joker.webp',
    'description' => 'The PTCG is a card game developed by Creatures Inc. based on the official Pokemon TCG. The PTCG features standard gameplay cards, energy cards, trainer cards, and stadium cards, a variant of trainer cards.',
])

<div class="w-full h-64 md:h-80 rounded-md overflow-hidden bg-cover bg-center mb-4 lg:bg-top xl:bg-center" style="background-image: url('{{ $bgimage }}')">
    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
        <div class="px-6 py-4 w-full max-w-2xl">
            <h2 class="text-2xl text-white font-semibold">{{ $title }}</h2>
            <p class="mt-2 text-white">{{ $description }}</p>
            <a href="{{ $href }}" class="inline-flex items-center mt-4 px-6 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                <span>Shop Now</span>
                <svg class="h-5 w-5 ml-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>