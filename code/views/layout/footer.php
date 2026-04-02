</div> <!-- /.container -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.like-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const idGame = this.dataset.gameId;

        fetch('/controllers/LikeController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id_game=' + idGame
        })
        .then(r => r.json())
        .then(data => {
            if (data.error) {
                window.location.href = '/views/auth/login.php';
                return;
            }
            btn.classList.toggle('btn-danger',         data.liked);
            btn.classList.toggle('btn-outline-danger', !data.liked);
            btn.textContent = data.liked ? 'Liked' : 'Like this game';
            btn.closest('.col-md-4')
               .querySelector('.like-counter').textContent = data.count;
        });
    });
});
</script>

</body>
</html>

