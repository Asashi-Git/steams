<?php if (!empty($_SESSION['form_errors'])): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($_SESSION['form_errors'] as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['form_errors']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['form_success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['form_success']) ?>
    </div>
    <?php unset($_SESSION['form_success']); ?>
<?php endif; ?>

<div class="row mt-4">

    {{-- LEFT COLUMN: game info --}}
    <div class="col-md-4 text-center">
        <img
            src="<?= htmlspecialchars($game['cover_image'] ?? '') ?>"
            alt="<?= htmlspecialchars($game['title']) ?>"
            class="img-fluid rounded shadow mb-3"
        >

        <button
            class="btn btn-outline-danger like-btn"
            data-game-id="<?= (int)$game['id_game'] ?>">
            Like this game
        </button>
        <span class="like-counter ms-2">0</span>
    </div>

    {{-- RIGHT COLUMN: details --}}
    <div class="col-md-8">

        <h1 class="fw-bold"><?= htmlspecialchars($game['title']) ?></h1>

        <?php if (!empty($game['release_date'])): ?>
            <p class="text-muted">Released: <?= htmlspecialchars($game['release_date']) ?></p>
        <?php endif; ?>

        <p class="mt-3"><?= nl2br(htmlspecialchars($game['description'])) ?></p>

    </div>

</div>

<hr class="my-5">

{{-- REVIEWS SECTION --}}
<div class="row">
    <div class="col-12">

        <h2 class="fw-bold mb-4">Reviews</h2>

        <?php if (empty($reviews)): ?>
            <p class="text-muted">No reviews yet. Be the first one!</p>
        <?php else: ?>
            <?php foreach ($reviews as $review): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0 fw-bold">
                                <?= htmlspecialchars($review['title']) ?>
                            </h5>
                            <span class="badge bg-primary fs-6">
                                <?= (int)$review['notation'] ?> / 10
                            </span>
                        </div>

                        <p class="text-muted small mb-2">
                            By <strong><?= htmlspecialchars($review['pseudo'] ?? 'Anonymous') ?></strong>
                        </p>

                        <p class="card-text">
                            <?= nl2br(htmlspecialchars($review['content'])) ?>
                        </p>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

<hr class="my-5">

{{-- WRITE / SHOW USER REVIEW --}}
<div class="row">
    <div class="col-md-8 offset-md-2">

        <?php if (!isset($_SESSION['user'])): ?>

            <div class="alert alert-info">
                <a href="/views/auth/login.php">Log in</a> to write a review.
            </div>

        <?php elseif ($userReview !== null): ?>

            <h3 class="mb-3">Your review</h3>
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold mb-0">
                            <?= htmlspecialchars($userReview['title']) ?>
                        </h5>
                        <span class="badge bg-primary fs-6">
                            <?= (int)$userReview['notation'] ?> / 10
                        </span>
                    </div>
                    <p><?= nl2br(htmlspecialchars($userReview['content'])) ?></p>
                </div>
            </div>

        <?php else: ?>

            <h3 class="mb-3">Write your review</h3>

            <form action="/controllers/ReviewController.php" method="POST">

                <input type="hidden" name="id_game"  value="<?= (int)$game['id_game'] ?>">
                <input type="hidden" name="rawg_id"  value="<?= (int)$game['rawg_id'] ?>">

                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Review title</label>
                    <input
                        type="text"
                        class="form-control"
                        id="title"
                        name="title"
                        placeholder="Sum up your opinion in one sentence"
                        required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Your review</label>
                    <textarea
                        class="form-control"
                        id="content"
                        name="content"
                        rows="5"
                        placeholder="Tell the community what you think..."
                        required></textarea>
                </div>

                <div class="mb-3">
                    <label for="notation" class="form-label fw-bold">Score (1 to 10)</label>
                    <input
                        type="number"
                        class="form-control"
                        id="notation"
                        name="notation"
                        min="1"
                        max="10"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Publish my review
                </button>

            </form>

        <?php endif; ?>

    </div>
</div>

