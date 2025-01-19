<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:feedback-modal />
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.dispatch('show-feedback-modal');
        });
    </script>
</x-app-layout> 