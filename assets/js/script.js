document.addEventListener('DOMContentLoaded', () => {
  let darkmode = localStorage.getItem("darkmode") || "inactive";
  console.log("darkmode:", darkmode); // Debugging

  const themeSwitch = document.getElementById("theme-switch");

  const enableDarkmode = () => {
    document.body.classList.add("darkmode");
    localStorage.setItem("darkmode", "active");
  };

  const disableDarkmode = () => {
    document.body.classList.remove("darkmode");
    localStorage.setItem("darkmode", "inactive");
  };

  // Inicializa o modo escuro se a chave no localStorage estiver ativa
  if (darkmode === "active") {
    enableDarkmode();
  }

  // Evento de clique no botão de alternância de tema
  themeSwitch.addEventListener("click", () => {
    darkmode = localStorage.getItem("darkmode");

    if (darkmode !== "active") {
      enableDarkmode(); // Ativa o modo escuro
    } else {
      disableDarkmode(); // Desativa o modo escuro
    }
  });
});
