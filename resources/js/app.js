import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Dark mode store (init() runs automatically on registration)
Alpine.store('darkMode', {
    on: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

    toggle() {
        this.on = !this.on;
        localStorage.theme = this.on ? 'dark' : 'light';
        this.updateDOM();
    },

    updateDOM() {
        document.documentElement.classList.toggle('dark', this.on);
    },

    init() {
        this.updateDOM();
    },
});

// Sidebar store
Alpine.store('sidebar', {
    isOpen: window.innerWidth >= 1024, // open on desktop, closed on mobile

    toggle() {
        this.isOpen = !this.isOpen;
        localStorage.setItem('sidebar', this.isOpen);
    },
});

// Start Alpine (keep this last)
Alpine.start();