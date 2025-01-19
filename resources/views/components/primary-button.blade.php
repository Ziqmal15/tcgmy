<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-2.5 bg-stone-900 border border-stone-700 text-white text-sm tracking-wider uppercase hover:bg-stone-800 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-stone-500 focus:ring-offset-2 focus:ring-offset-stone-900']) }}>
    {{ $slot }}
</button>
