import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'bootstrap-icons/font/bootstrap-icons.css';

// ─── Button Ripple Effect ───
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn:not(.btn-link):not(.nav-link)');
    if (!btn) return;

    const rect = btn.getBoundingClientRect();
    const ripple = document.createElement('span');
    ripple.style.cssText = `
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        width: 60px; height: 60px;
        left: ${e.clientX - rect.left - 30}px;
        top: ${e.clientY - rect.top - 30}px;
        pointer-events: none;
        animation: rippleAnim 0.5s ease-out forwards;
    `;
    btn.style.position = 'relative';
    btn.style.overflow = 'hidden';
    btn.appendChild(ripple);
    setTimeout(() => ripple.remove(), 500);
});

// Inject ripple keyframe if not present
if (!document.getElementById('ripple-style')) {
    const style = document.createElement('style');
    style.id = 'ripple-style';
    style.textContent = `
        @keyframes rippleAnim {
            from { transform: scale(0); opacity: 1; }
            to { transform: scale(4); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
}

// ─── Intersection Observer for scroll-triggered animations ───
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.card, .table, .row.g-4 > div').forEach(el => {
    observer.observe(el);
});

// ─── Count-up animation for dashboard stat numbers ───
document.querySelectorAll('.card .mb-0').forEach(el => {
    const text = el.textContent.trim();
    const target = parseInt(text, 10);
    if (isNaN(target) || target === 0) return;

    const duration = 800;
    const start = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target);
        if (progress < 1) requestAnimationFrame(update);
        else el.textContent = target;
    }

    requestAnimationFrame(update);
});

// ─── Sidebar mobile toggle (responsive) ───
const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.querySelector('.navbar-toggler');

if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });

    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768 &&
            !sidebar.contains(e.target) &&
            !toggleBtn.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });
}

// ─── Auto-dismiss alerts after 5s ───
document.querySelectorAll('.alert-dismissible').forEach(alert => {
    setTimeout(() => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    }, 5000);
});

// ─── Smooth scroll for anchor links ───
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        const target = document.querySelector(href);
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
