document.addEventListener("DOMContentLoaded", function () {

    const likeBtn = document.querySelector(".like-btn");

    if (!likeBtn) return;

    likeBtn.addEventListener("click", function () {

        const gameId = likeBtn.dataset.gameId;

        // Build form data for the POST body
        const formData = new FormData();
        formData.append("id_game", gameId);

        fetch("/api.php?action=like", {
            method: "POST",
            body:   formData,
        })
        .then(function (response) {

            // User not connected — redirect to login
            if (response.status === 401) {
                window.location.href = "/views/auth/login.php";
                return null;
            }

            return response.json();
        })
        .then(function (data) {

            if (!data) return;

            if (data.error) {
                console.error(data.error);
                return;
            }

            // Update the button text and counter
            const counter = document.querySelector(".like-counter");

            if (data.liked) {
                likeBtn.classList.remove("btn-outline-danger");
                likeBtn.classList.add("btn-danger");
                likeBtn.textContent = "Liked";
            } else {
                likeBtn.classList.remove("btn-danger");
                likeBtn.classList.add("btn-outline-danger");
                likeBtn.textContent = "Like this game";
            }

            if (counter) {
                counter.textContent = data.count;
            }
        })
        .catch(function (err) {
            console.error("Network error:", err);
        });
    });
});

