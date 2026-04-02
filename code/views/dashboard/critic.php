<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">My Reviews</h2>
</div>

<?php if (empty($myReviews)): ?>
    <div class="alert alert-info">You have not written any review yet.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover align-middle bg-white rounded shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Game</th>
                    <th>Title</th>
                    <th>Score</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($myReviews as $review): ?>
                <tr>
                    <td>
                        <a href="/game.php?rawg_id=<?= (int)$review['rawg_id'] ?>">
                            <?= htmlspecialchars($review['game_title']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($review['title']) ?></td>
                    <td>
                        <span class="badge bg-primary"><?= (int)$review['notation'] ?>/10</span>
                    </td>
                    <td><?= htmlspecialchars($review['creation_date']) ?></td>
                    <td>
                        <form method="POST" action="/dashboard.php"
                              onsubmit="return confirm('Delete this review?')">
                            <input type="hidden" name="action"    value="delete_own_review">
                            <input type="hidden" name="id_review" value="<?= (int)$review['id_review'] ?>">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

