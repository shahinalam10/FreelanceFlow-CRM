// Dark mode toggle
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const themeIconPath = document.getElementById('themeIconPath');

// Check for saved theme preference or use system preference
const savedTheme = localStorage.getItem('theme');
const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
    document.documentElement.classList.add('dark');
    themeIconPath.setAttribute('d', 'M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z');
}

themeToggle.addEventListener('click', () => {
    const isDark = document.documentElement.classList.toggle('dark');
    
    if (isDark) {
        themeIconPath.setAttribute('d', 'M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z');
        localStorage.setItem('theme', 'dark');
    } else {
        themeIconPath.setAttribute('d', 'M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z');
        localStorage.setItem('theme', 'light');
    }
});

// Set current year in footer
document.getElementById('currentYear').textContent = new Date().getFullYear();

// Simulate auth state (in a real app, this would come from your auth system)
function checkAuth() {
    // This is just for demonstration
    // In a real app, you would check your actual auth state
    const isAuthenticated = false; // Change to true to see the dashboard button
    
    const authButtons = document.getElementById('authButtons');
    const ctaButton = document.getElementById('ctaButton');
    if (isAuthenticated) {
        authButtons.innerHTML = '<a href="/dashboard" class="px-3 sm:px-4 py-1 sm:py-2 text-sm sm:text-base bg-primary text-white rounded-lg hover:bg-primary-hover dark:bg-blue-700 dark:hover:bg-blue-800 transition-smooth font-medium">Dashboard</a>';
        ctaButton.textContent = 'Go to Dashboard';
        ctaButton.href = '/dashboard';
    }
}

// Check auth state on load
checkAuth();

// Add intersection observer for scroll animations
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.animate__animated');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add(entry.target.dataset.animate);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    elements.forEach(element => {
        observer.observe(element);
    });
};

// Initialize scroll animations
window.addEventListener('DOMContentLoaded', animateOnScroll);