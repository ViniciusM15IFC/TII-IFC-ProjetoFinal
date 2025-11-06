document.querySelectorAll('.rating input').forEach(radio => {
    radio.addEventListener('change', function() {
        const value = this.value;
        const textElement = document.getElementById(`notaTexto${this.name.charAt(0).toUpperCase() + this.name.slice(1)}`);
        textElement.textContent = `Você avaliou com ${value} estrela${value > 1 ? 's' : ''}`;
    });
});
