document.addEventListener("DOMContentLoaded", function () {
  const categoriaSelect = document.getElementById("categoria");

  const formFilme = document.getElementById("form-filme");
  const formSerie = document.getElementById("form-serie");
  const formLivro = document.getElementById("form-livro");

  // Esconde todos de início
  function esconderTodos() {
    formFilme.style.display = "none";
    formSerie.style.display = "none";
    formLivro.style.display = "none";
  }

  esconderTodos(); // inicializa com tudo oculto

  // Função pra mostrar o correto
  function mostrarFormulario(categoriaSelecionada) {
    esconderTodos();

    switch (categoriaSelecionada.toLowerCase()) {
      case "filme":
      case "1": // caso use ID numérico no banco
        formFilme.style.display = "block";
        break;
      case "serie":
      case "série":
      case "2":
        formSerie.style.display = "block";
        break;
      case "livro":
      case "3":
        formLivro.style.display = "block";
        break;
      default:
        // Nenhum selecionado → mantém tudo escondido
        break;
    }
  }

  // Detecta mudança no select
  categoriaSelect.addEventListener("change", function () {
    const categoriaSelecionada = categoriaSelect.options[categoriaSelect.selectedIndex].text;
    mostrarFormulario(categoriaSelecionada);
  });
});
