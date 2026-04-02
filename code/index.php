<?php

session_start();

require_once __DIR__ . '/services/RawgService.php';
require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/GameModel.php';
require_once __DIR__ . '/controllers/GameController.php';

// --- Database: load all saved games
try {
    $gameModel      = new GameModel();
    $gameController = new GameController();
    $games          = $gameModel->findAllWithStats();

    // Attach like count to each game, then sort descending
    foreach ($games as &$game) {
        $game['like_count'] = $gameController->getLikeCount((int)$game['id_game']);
    }
    unset($game);

    usort($games, fn($a, $b) => $b['like_count'] <=> $a['like_count']);

} catch (RuntimeException $e) {
    $dbError = $e->getMessage();
} catch (PDOException $e) {
    $dbError = $e->getMessage();
}

// --- RAWG API: search
$results = [];
$error   = null;
$query   = '';

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $query = trim($_GET['q']);

    try {
        $service = new RawgService();
        $results = $service->searchGames($query);
    } catch (RuntimeException $e) {
        $error = "Erreur lors de la récupération des données.";
    }
}

// --- Layout
$pageTitle = 'Revieweo — Search';
require_once __DIR__ . '/views/layout/header.php';
?>

<h1 class="fw-bold mb-4">Search for a game</h1>

<form method="GET" action="" class="d-flex gap-2 mb-4">
    <input
        type="text"
        name="q"
        class="form-control"
        placeholder="Game title..."
        value="<?= htmlspecialchars($query) ?>"
        autofocus
    />
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<!-- ===== RAWG API RESULTS ===== -->
<?php if (!empty($results)): ?>
    <p>Results for: <strong><?= htmlspecialchars($query) ?></strong></p>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php foreach ($results as $game): ?>
            <div class="col">
                <a
                    href="game.php?rawg_id=<?= (int)$game['id'] ?>"
                    class="text-decoration-none text-dark"
                >
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($game['background_image'])): ?>
                            <img
                                src="<?= htmlspecialchars($game['background_image']) ?>"
                                class="card-img-top"
                                style="height:160px; object-fit:cover;"
                                alt="<?= htmlspecialchars($game['name']) ?>"
                            />
                        <?php else: ?>
                            <div class="bg-secondary text-white d-flex align-items-center
                                        justify-content-center" style="height:160px;">
                                No image
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <?= htmlspecialchars($game['name']) ?>
                            </h5>
                            <p class="card-text small text-muted mb-1">
                                Released: <?= htmlspecialchars($game['released'] ?? 'Unknown') ?>
                            </p>
                            <p class="card-text small">
                                Rating: <strong><?= htmlspecialchars($game['rating'] ?? 'N/A') ?></strong> / 5
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php elseif ($query && !$error): ?>
    <p class="text-muted">No results for this search.</p>
<?php endif; ?>

<!-- ===== SAVED GAMES IN DATABASE ===== -->
<hr class="my-5">
<h2 class="fw-bold mb-4">Games in database</h2>

<?php if (!empty($games)): ?>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php foreach ($games as $game): ?>
            <div class="col">
                <a
                    href="game.php?rawg_id=<?= (int)$game['rawg_id'] ?>"
                    class="text-decoration-none text-dark"
                >
                    <div class="card h-100 shadow-sm">

                        <?php if (!empty($game['cover_image'])): ?>
                            <img
                                src="<?= htmlspecialchars($game['cover_image']) ?>"
                                class="card-img-top"
                                style="height:160px; object-fit:cover;"
                                alt="<?= htmlspecialchars($game['title']) ?>"
                            />
                        <?php else: ?>
                            <div class="bg-secondary text-white d-flex align-items-center
                                        justify-content-center" style="height:160px;">
                                No image
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <?= htmlspecialchars($game['title']) ?>
                            </h5>

                            <p class="card-text small mb-1">
                                <span class="badge bg-danger">
                                    ♥ <?= (int)$game['like_count'] ?> like<?= $game['like_count'] != 1 ? 's' : '' ?>
                                </span>
                            </p>

                            <?php if ($game['review_count'] > 0): ?>
                                <p class="card-text small mb-0">
                                    Reviewer score:
                                    <strong class="text-warning">
                                        <?= $game['avg_score'] ?> / 10
                                    </strong>
                                </p>
                                <p class="card-text small text-muted">
                                    <?= (int)$game['review_count'] ?> review<?= $game['review_count'] > 1 ? 's' : '' ?>
                                </p>
                            <?php else: ?>
                                <p class="card-text small text-muted">No reviews yet</p>
                            <?php endif; ?>
                        </div>

                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

<?php elseif (isset($dbError)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($dbError) ?></div>
<?php else: ?>
    <p class="text-muted">No games in the database yet.</p>
<?php endif; ?>


<?php require_once __DIR__ . '/views/layout/footer.php'; ?>

