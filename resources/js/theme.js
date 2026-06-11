// Dark mode toggle: persists in localStorage, applied to <html class="dark">
(function initTheme() {
    const root = document.documentElement;
    const saved = localStorage.getItem('theme');
    if (saved === 'dark') root.classList.add('dark');
    else if (saved === 'light') root.classList.remove('dark');
})();

function applyTheme(isDark) {
    document.documentElement.classList.toggle('dark', isDark);
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    document.querySelectorAll('[data-theme-toggle]').forEach((el) => {
        if (el.type === 'checkbox') el.checked = isDark;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const isDark = document.documentElement.classList.contains('dark');
    document.querySelectorAll('[data-theme-toggle]').forEach((el) => {
        if (el.type === 'checkbox') el.checked = isDark;
        el.addEventListener('change', (e) => {
            const target = e.currentTarget;
            const next = target.type === 'checkbox'
                ? target.checked
                : !document.documentElement.classList.contains('dark');
            applyTheme(next);
        });
        el.addEventListener('click', (e) => {
            if (e.currentTarget.tagName === 'BUTTON') {
                e.preventDefault();
                applyTheme(!document.documentElement.classList.contains('dark'));
            }
        });
    });
});

window.DonasiLink = window.DonasiLink || {};
window.DonasiLink.toggleTheme = () => applyTheme(!document.documentElement.classList.contains('dark'));
