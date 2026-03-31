const searchInput = document.getElementById("search");
const searchBtn = document.getElementById("searchBtn");
const gamesContainer = document.getElementById("games");
const message = document.getElementById("message");

async function searchGames() {
  const query = searchInput.value.trim();

  gamesContainer.innerHTML = "";
  message.textContent = "";

  if (!query) {
    message.textContent = "Veuillez entrer un nom de jeu.";
    return;
  }

  message.textContent = "Chargement...";

  try {
    const response = await fetch(`api.php?q=${encodeURIComponent(query)}`);
    const data = await response.json();

    gamesContainer.innerHTML = "";
    message.textContent = "";

    if (data.error) {
      message.textContent = data.error;
      return;
    }

    if (!Array.isArray(data) || data.length === 0) {
      message.textContent = "Aucun résultat trouvé.";
      return;
    }

    data.forEach((game) => {
      const card = document.createElement("article");
      card.className = "card";

      const imageHtml = game.background_image
        ? `<img src="${game.background_image}" alt="${game.name}">`
        : `<div class="no-image">Image non disponible</div>`;

      card.innerHTML = `
        ${imageHtml}
        <div class="card-content">
          <h3>${game.name}</h3>
          <p><strong>Date :</strong> ${game.released || "Inconnue"}</p>
          <p><strong>Note :</strong> ${game.rating || "N/A"} / 5</p>
        </div>
      `;

      gamesContainer.appendChild(card);
    });
  } catch (error) {
    console.error("Erreur :", error);
    message.textContent = "Erreur lors du chargement des données.";
  }
}

searchBtn.addEventListener("click", searchGames);

searchInput.addEventListener("keydown", (event) => {
  if (event.key === "Enter") {
    searchGames();
  }
});