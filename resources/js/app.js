import './bootstrap';
import Alpine from 'alpinejs';

// Initialize Alpine store for sidebar with default state
Alpine.store('sidebar', {
    isOpen: window.innerWidth >= 1024, // Default open on desktop, closed on mobile
    toggle() {
        this.isOpen = !this.isOpen;
        localStorage.setItem('sidebar', this.isOpen);
    }
});

// Initialize Alpine store for dark mode
Alpine.store('darkMode', {
    on: localStorage.getItem('theme') === 'dark',
    toggle() {
        this.on = !this.on;
        localStorage.setItem('theme', this.on ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.on);
    }
});

window.Alpine = Alpine;
Alpine.start();
