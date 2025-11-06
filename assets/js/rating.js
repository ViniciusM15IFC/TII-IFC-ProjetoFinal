document.addEventListener('DOMContentLoaded', function() {
    function initializeRating() {
        const starContainers = document.querySelectorAll('.rating-stars');
        
        starContainers.forEach(container => {
            const stars = container.querySelectorAll('.star');
            
            stars.forEach(star => {
                // Remove listeners anteriores para evitar duplicação
                star.removeEventListener('click', handleStarClick);
                star.addEventListener('click', handleStarClick);
            });
        });
    }

    function handleStarClick(event) {
        const star = event.currentTarget;
        const value = parseFloat(star.getAttribute('data-value'));
        const container = star.closest('.rating-stars');
        const inputId = container.getAttribute('data-input');
        const input = document.getElementById(inputId);
        
        if (!input) return;
        
        // Converte para escala de 1-10 (5 estrelas = 10)
        input.value = Math.round(value * 2); 
        
        // Atualiza visualmente as estrelas
        const stars = container.querySelectorAll('.star');
        stars.forEach(s => {
            const sValue = parseFloat(s.getAttribute('data-value'));
            const isHalf = s.classList.contains('half');
            
            if (!isHalf) {
                // Estrela cheia - mostrar ou esconder
                if (sValue <= value) {
                    s.setAttribute('icon', 'ic:round-star');
                } else {
                    s.setAttribute('icon', 'ic:round-star-border');
                }
            } else {
                // Meia estrela - só mostrar se o valor está entre a estrela anterior e a atual
                if (sValue <= value && value < sValue + 0.5) {
                    s.setAttribute('icon', 'ic:round-star-half');
                } else {
                    s.setAttribute('icon', 'ic:round-star-border');
                }
            }
        });

        // Atualiza o texto com a nota (removendo "nota" do começo)
        const notaTextoId = 'notaTexto' + inputId.substring(4); // Remove "nota" do começo
        const notaTexto = document.getElementById(notaTextoId);
        if (notaTexto) {
            notaTexto.textContent = `Nota: ${value} / 5 (${input.value} / 10)`;
        }
    }

    // Inicializa ao carregar
    initializeRating();

    // Observa mudanças no DOM para elementos criados dinamicamente
    const observer = new MutationObserver(function(mutations) {
        initializeRating();
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});