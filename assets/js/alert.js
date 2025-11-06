document.addEventListener('DOMContentLoaded', function() {
    const mensagem = window.mensagemSessao;
    
    if (mensagem && mensagem.trim() !== '') {
        const alertDiv = document.getElementById('notificacaoMensagem');
        
        // Determina o tipo de alerta
        if (mensagem.toLowerCase().includes('sucesso')) {
            alertDiv.className = 'alert alert-success';
        } else if (mensagem.toLowerCase().includes('erro')) {
            alertDiv.className = 'alert alert-danger';
        } else {
            alertDiv.className = 'alert alert-info';
        }
        
        alertDiv.textContent = mensagem;
        
        // Abre o modal
        const modal = new bootstrap.Modal(document.getElementById('notificacaoModal'));
        modal.show();
    }
});