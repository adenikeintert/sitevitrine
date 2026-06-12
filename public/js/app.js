const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('visible');
    });
}, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));

    // Header scroll
    const header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', () => header.classList.toggle('scrolled', window.scrollY > 50));
    }

    // Mobile menu
    const toggle = document.getElementById('menuToggle');
    const menu = document.getElementById('mobileMenu');
    if (toggle && menu) {
        toggle.addEventListener('click', () => menu.classList.toggle('hidden'));
        menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => menu.classList.add('hidden')));
    }

    // Hero slider
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const texts = document.querySelectorAll('.hero-text');
    if (slides.length > 1) {
        let current = 0;
        const show = (i) => {
            slides.forEach((s, j) => { s.classList.toggle('opacity-100', j === i); s.classList.toggle('opacity-0', j !== i); });
            dots.forEach((d, j) => { d.classList.toggle('w-8', j === i); d.classList.toggle('bg-accent', j === i); d.classList.toggle('w-4', j !== i); d.classList.toggle('bg-white/40', j !== i); });
            texts.forEach((t, j) => { t.classList.toggle('opacity-100', j === i); t.classList.toggle('translate-y-0', j === i); t.classList.toggle('opacity-0', j !== i); t.classList.toggle('translate-y-8', j !== i); });
        };
        setInterval(() => { current = (current + 1) % slides.length; show(current); }, 5000);
        dots.forEach((d, i) => d.addEventListener('click', () => { current = i; show(i); }));
        document.getElementById('heroPrev')?.addEventListener('click', () => { current = (current - 1 + slides.length) % slides.length; show(current); });
        document.getElementById('heroNext')?.addEventListener('click', () => { current = (current + 1) % slides.length; show(current); });
    }

    // Counter animation
    document.querySelectorAll('[data-count]').forEach(el => {
        const io = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(el.dataset.count);
                    const suffix = el.dataset.suffix || '';
                    let count = 0;
                    const step = Math.ceil(target / 40);
                    const timer = setInterval(() => {
                        count += step;
                        if (count >= target) { count = target; clearInterval(timer); }
                        el.textContent = count + suffix;
                    }, 40);
                    io.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        io.observe(el);
    });
});