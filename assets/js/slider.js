document.addEventListener('DOMContentLoaded', () => {
    const scrollAmount = 220;
    const duration = 400;

    // Função de suavização (ease-in-out)
    function easeInOutQuad(t) {
        return t < 0.5
            ? 2 * t * t
            : -1 + (4 - 2 * t) * t;
    }

    function animateScroll(element, change, duration) {
        const start = element.scrollLeft;
        const startTime = performance.now();

        function animate(time) {
            const elapsed = time - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = easeInOutQuad(progress);
            element.scrollLeft = start + change * eased;

            if (progress < 1) requestAnimationFrame(animate);
        }

        requestAnimationFrame(animate);
    }

    document.querySelectorAll('.slider-container').forEach(container => {
        const slider = container.querySelector('.slider');

        container.querySelector('.btn-left')?.addEventListener('click', () => {
            animateScroll(slider, -scrollAmount, duration);
        });

        container.querySelector('.btn-right')?.addEventListener('click', () => {
            animateScroll(slider, scrollAmount, duration);
        });
    });
});
