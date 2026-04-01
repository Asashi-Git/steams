<h2 class="fw-bold mb-4">Admin Dashboard</h2>

<!-- ── Reviews ───────────────────────────────────────────── -->
<h4 class="mb-3">All Reviews</h4>

<?php if (empty($allReviews)): ?>
    <div class="alert alert-info mb-4">No reviews yet.</div>
<?php else: ?>
    <div class="table-responsive mb-5">
        <table class="table table-hover align-middle bg-white rounded shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Game</th>
                    <th>Review title</th>
                    <th>Author</th>
                    <th>Score</th>
                    <th>Pinned</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allReviews as $review): ?>
                <tr>
                    <td>
                        <a href="/game.php?rawg_id=<?= (int)$review['rawg_id'] ?>">
                            <?= htmlspecialchars($review['game_title']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($review['title']) ?></td>
                    <td><?= htmlspecialchars($review['username']) ?></td>
                    <td>
                        <span class="badge bg-primary"><?= (int)$review['notation'] ?>/10</span>
                    </td>
                    <td>
                        <?php if ($review['pinned']): ?>
                            <span class="badge bg-warning text-dark">Pinned</span>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($review['created_at']) ?></td>
                    <td class="d-flex gap-1">
                        <!-- Pin / Unpin -->
                        <form method="POST" action="/dashboard.php">
                            <input type="hidden" name="action"    value="pin_review">
                            <input type="hidden" name="id_review" value="<?= (int)$review['id_review'] ?>">
                            <button class="btn btn-warning btn-sm">
                                <?= $review['pinned'] ? 'Unpin' : 'Pin' ?>
                            </button>
                        </form>
                        <!-- Delete -->
                        <form method="POST" action="/dashboard.php"
                              onsubmit="return confirm('Delete this review?')">
                            <input type="hidden" name="action"    value="delete_review">
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

<!-- ── Users ─────────────────────────────────────────────── -->
<h4 class="mb-3">All Users</h4>

<?php if (empty($allUsers)): ?>
    <div class="alert alert-info">No users found.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover align-middle bg-white rounded shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $u): ?>
                <tr>
                    <td><?= (int)$u['id_user'] ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <span class="badge bg-secondary">
                            <?= htmlspecialchars($u['role_title']) ?>
                        </span>
                    </td>
                    <td>
                        <!-- Prevent admin from deleting themselves -->
                        <?php if ((int)$u['id_user'] !== (int)$_SESSION['user']['id']): ?>
                        <form method="POST" action="/dashboard.php"
                              onsubmit="return confirm('Delete this user and all their reviews?')">
                            <input type="hidden" name="action"  value="delete_user">
                            <input type="hidden" name="id_user" value="<?= (int)$u['id_user'] ?>">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <?php else: ?>
                            <span class="text-muted">You</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

