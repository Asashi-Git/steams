<?php

require_once __DIR__ . '/services/RawgService.php';
require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/GameModel.php';

try {
    $gameModel = new GameModel();
    $games     = $gameModel->findAll();
} catch (RuntimeException $e) {
    $dbError = "Cannot reach the database.";
}

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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RAWG Test</title>
    <link rel="icon" href="data:,">
    <style>
        body        { font-family: sans-serif; max-width: 900px; margin: 40px auto; padding: 0 20px; }
        input       { padding: 8px; width: 300px; }
        button      { padding: 8px 16px; cursor: pointer; }
        .error      { color: red; margin-top: 16px; }
        .grid       { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px; }
        .card       { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .card img   { width: 100%; height: 160px; object-fit: cover; }
        .card-body  { padding: 12px; }
        .no-image   { height: 160px; background: #eee; display: flex; align-items: center; justify-content: center; color: #999; }
        .separator  { border: none; border-top: 2px solid #eee; margin: 40px 0; }
    </style>
</head>
<body>

    <h1>Recherche de jeux — RAWG API</h1>

    <form method="GET" action="">
        <input
            type="text"
            name="q"
            placeholder="Nom du jeu..."
            value="<?= htmlspecialchars($query) ?>"
            autofocus
        />
        <button type="submit">Rechercher</button>
    </form>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- ===== DATABASE SECTION ===== -->
    <hr class="separator">
    <h2>Jeux en base de données</h2>

    <?php if (!empty($games)): ?>
        <ul>
            <?php foreach ($games as $game): ?>
                <li><?= htmlspecialchars($game['title']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($dbError)): ?>
        <p style="color:red"><?= $dbError ?></p>
    <?php else: ?>
        <p>Aucun jeu en base de données pour le moment.</p>
    <?php endif; ?>

    <!-- ===== RAWG API SECTION ===== -->
    <hr class="separator">

    <?php if (!empty($results)): ?>
        <p>Résultats pour : <strong><?= htmlspecialchars($query) ?></strong></p>
        <div class="grid">
            <?php foreach ($results as $game): ?>
                <div class="card">
                    <?php if (!empty($game['background_image'])): ?>
                        <img
                            src="<?= htmlspecialchars($game['background_image']) ?>"
                            alt="<?= htmlspecialchars($game['name']) ?>"
                        />
                    <?php else: ?>
                        <div class="no-image">Image non disponible</div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h3><?= htmlspecialchars($game['name']) ?></h3>
                        <p><strong>Date :</strong> <?= htmlspecialchars($game['released'] ?? 'Inconnue') ?></p>
                        <p><strong>Note :</strong> <?= htmlspecialchars($game['rating'] ?? 'N/A') ?> / 5</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($query && !$error): ?>
        <p>Aucun résultat pour cette recherche.</p>
    <?php endif; ?>

</body>
</html>

