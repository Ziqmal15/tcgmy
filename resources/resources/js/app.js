import './bootstrap';
import Alpine from 'alpinejs';

// Wait for Livewire to load before starting Alpine
document.addEventListener('livewire:load', function () {
    window.Alpine = Alpine;
    Alpine.start();
});