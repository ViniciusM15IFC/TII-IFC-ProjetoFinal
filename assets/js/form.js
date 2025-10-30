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

    switch (categoriaSelecionada) {
      case "1":  // Filme
        formFilme.style.display = "block";
        break;
      case "2":  // Série
        formSerie.style.display = "block";
        break;
      case "3":  // Livro
        formLivro.style.display = "block";
        break;
      default:
        // Nenhum selecionado → mantém tudo escondido
        break;
    }
  }

  // Detecta mudança no select
  categoriaSelect.addEventListener("change", function () {
    mostrarFormulario(categoriaSelect.value);  // passa o valor numérico
  });

  // Inicia a exibição com a categoria selecionada por padrão
  mostrarFormulario(categoriaSelect.value);
});
