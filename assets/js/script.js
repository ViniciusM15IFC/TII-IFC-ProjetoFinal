document.addEventListener('DOMContentLoaded', () => {
  let darkmode = localStorage.getItem("darkmode") || "inactive";
  console.log("darkmode:", darkmode);

  const themeSwitch = document.getElementById("theme-switch");

  const enableDarkmode = () => {
    document.body.classList.add("darkmode");
    localStorage.setItem("darkmode", "active");
    darkmode = "active"; // Atualiza a variável também
  };

  const disableDarkmode = () => {
    document.body.classList.remove("darkmode");
    localStorage.setItem("darkmode", "inactive");
    darkmode = "inactive"; // Atualiza a variável também
  };

  // Inicializa o modo escuro se estava ativo
  if (darkmode === "active") {
    enableDarkmode();
  }

  // Listener ÚNICO para o clique
  if (themeSwitch) {
    themeSwitch.addEventListener("click", (e) => {
      e.preventDefault(); // Evita comportamentos padrão
      
      // Lê sempre do localStorage para garantir sincronização
      const currentMode = localStorage.getItem("darkmode");
      
      if (currentMode !== "active") {
        enableDarkmode();
      } else {
        disableDarkmode();
      }
    });
  }
});