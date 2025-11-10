document.addEventListener('DOMContentLoaded', () => {
    const duration = 10; // duração mais longa = transição mais fluida
    let isScrolling = false;

    // Função de suavização (easeInOutCubic)
    function easeInOutCubic(t) {
        return t < 0.5
            ? 4 * t * t * t
            : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    function animateScroll(element, change, duration) {
        const start = element.scrollLeft;
        const startTime = performance.now();

        function animate(time) {
            const elapsed = time - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = easeInOutCubic(progress);
            element.scrollLeft = start + change * eased;

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                isScrolling = false;
            }
        }

        requestAnimationFrame(animate);
    }

    document.querySelectorAll('.slider-container').forEach(container => {
        const slider = container.querySelector('.slider');

        // Detecta automaticamente a largura de um item (filme)
        const firstItem = slider.querySelector('.card, .filme, .item, div'); 
        const itemWidth = firstItem ? firstItem.offsetWidth + 16 : 300; 
        // (adiciona margem de ~16px pra compensar o gap)

        container.querySelectorAll('.btn-slide').forEach(button => {
            button.addEventListener('click', () => {
                if (isScrolling) return;
                isScrolling = true;

                const direction = button.classList.contains('btn-left') ? -1 : 1;
                const change = direction * itemWidth;

                animateScroll(slider, change, duration);
            });
        });
    });
});
