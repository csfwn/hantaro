import { onMounted, ref } from 'vue';

type Appearance = 'light' | 'dark' | 'system';

/**
 * Apply the theme to the document
 */
export function updateTheme(value: Appearance) {
    if (typeof window === 'undefined') return;

    if (value === 'system') {
        const mediaQueryList = window.matchMedia('(prefers-color-scheme: dark)');
        const systemTheme = mediaQueryList.matches ? 'dark' : 'light';

        document.documentElement.classList.toggle('dark', systemTheme === 'dark');
    } else {
        document.documentElement.classList.toggle('dark', value === 'dark');
    }
}

/**
 * Set a cookie for SSR support
 */
const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') return;

    const maxAge = days * 24 * 60 * 60;
    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

/**
 * Helper to get saved appearance from localStorage
 */
const getStoredAppearance = (): Appearance | null => {
    if (typeof window === 'undefined') return null;
    return localStorage.getItem('appearance') as Appearance | null;
};

/**
 * Handle system theme changes
 */
const handleSystemThemeChange = () => {
    const currentAppearance = getStoredAppearance();
    updateTheme(currentAppearance || 'system');
};

/**
 * Initialize theme on app load
 */
export function initializeTheme() {
    if (typeof window === 'undefined') return;

    const savedAppearance = getStoredAppearance();

    // Default to 'light' if no saved preference
    updateTheme(savedAppearance || 'light');

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)')?.addEventListener('change', handleSystemThemeChange);
}

/**
 * Reactive appearance state
 */
const appearance = ref<Appearance>('light');

/**
 * Composable for managing appearance
 */
export function useAppearance() {
    onMounted(() => {
        const savedAppearance = localStorage.getItem('appearance') as Appearance | null;
        appearance.value = savedAppearance || 'light'; // default to light
    });

    function updateAppearance(value: Appearance) {
        appearance.value = value;

        // Persist preference
        localStorage.setItem('appearance', value);
        setCookie('appearance', value);

        // Apply theme
        updateTheme(value);
    }

    return {
        appearance,
        updateAppearance,
    };
}
