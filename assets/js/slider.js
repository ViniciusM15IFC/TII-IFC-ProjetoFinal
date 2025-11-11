// ../assets/js/slider.js
document.addEventListener("DOMContentLoaded", () => {
  const DURATION = 900; // ms
  const EASING = t => t < 0.5
    ? 4 * t * t * t
    : 1 - Math.pow(-2 * t + 2, 3) / 2;

  document.querySelectorAll(".slider-container").forEach(container => {
    // tenta localizar o elemento realmente scrollável dentro do container
    let slider = container.querySelector(".slider");
    // se você tiver wrappers extras, cheque filhos que podem ser scrolláveis
    if (!slider) {
      slider = Array.from(container.children).find(el => {
        const style = getComputedStyle(el);
        return (style.overflowX === "auto" || style.overflowX === "scroll") && el.scrollWidth > el.clientWidth;
      }) || container.querySelector(".d-flex, .overflow-auto");
    }

    if (!slider) {
      console.warn("slider.js: nenhum elemento scrollável encontrado em", container);
      return;
    }

    // força comportamento para evitar conflito com CSS smooth
    slider.style.scrollBehavior = 'auto';
    slider.style.overflowX = slider.style.overflowX || 'auto';

    const btnLeft = container.querySelector(".btn-left");
    const btnRight = container.querySelector(".btn-right");

    // flag local por container
    let animating = false;

    // calcula passo de rolagem no momento do clique (mais confiável)
    function computeStep() {
      const visible = slider.clientWidth;
      const gap = parseFloat(getComputedStyle(slider).gap) || 16;
      // pega o primeiro filho direto que representa um item
      const first = slider.querySelector(":scope > *");
      const itemWidth = first ? Math.round(first.getBoundingClientRect().width + gap) : Math.round(visible * 0.5);
      // quantos cabem visivelmente
      const visibleCount = Math.max(1, Math.floor(visible / itemWidth));
      // rolar por visibleCount itens (ajusta fração se quiser)
      return Math.max(1, itemWidth * visibleCount * 0.5);

    }

    function smoothScrollTo(target) {
      if (animating) return;
      animating = true;

      const start = slider.scrollLeft;
      const end = Math.max(0, Math.min(target, slider.scrollWidth - slider.clientWidth));
      const startTime = performance.now();

      // se já estiver no lugar, não anima
      if (Math.abs(end - start) < 1) {
        slider.scrollLeft = end;
        animating = false;
        return;
      }

      function frame(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / DURATION, 1);
        const eased = EASING(progress);
        slider.scrollLeft = start + (end - start) * eased;

        if (progress < 1) {
          requestAnimationFrame(frame);
        } else {
          slider.scrollLeft = end; // garante precisão
          animating = false;
        }
      }

      requestAnimationFrame(frame);
    }

    // handlers
    btnLeft?.addEventListener("click", (e) => {
      e.preventDefault();
      const step = computeStep();
      smoothScrollTo(slider.scrollLeft - step);
    });

    btnRight?.addEventListener("click", (e) => {
      e.preventDefault();
      const step = computeStep();
      smoothScrollTo(slider.scrollLeft + step);
    });

    // roda com a roda do mouse (horizontalize wheel quando apropriado)
    slider.addEventListener("wheel", (e) => {
      if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
        // vertical wheel -> transformamos em horizontal scroll
        e.preventDefault();
        slider.scrollLeft += e.deltaY;
      }
    }, { passive: false });

    // opcional: atualizar tabindex nos itens para acessibilidade (deixa foco visual)
    slider.querySelectorAll(":scope > *").forEach(el => {
      if (!el.hasAttribute("tabindex")) el.setAttribute("tabindex", "0");
    });
  });
});
