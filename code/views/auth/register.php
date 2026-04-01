<?php
$pageTitle = 'Register — Revieweo';
require_once __DIR__ . '/../../views/layout/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-5">

        <h2 class="mb-4 text-center">Create an account</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="/auth.php?action=register">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required
                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input type="password" name="confirm" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create account</button>

        </form>

        <p class="mt-3 text-center">
            Already have an account? <a href="/auth.php?action=login">Sign in</a>
        </p>

    </div>
</div>

<?php require_once __DIR__ . '/../../views/layout/footer.php'; ?>

