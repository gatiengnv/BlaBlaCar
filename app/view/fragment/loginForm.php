<?php include 'fragmentBlaBlaCarHeader.html'; ?>


<div class="container d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="card shadow-sm border-0 rounded-4" style="max-width: 480px; width: 100%;">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">Connexion</h2>
                <p class="text-muted mb-0">Accédez à votre espace BlaBlaCar</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger rounded-3" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="router.php" method="post">
                <input type="hidden" name="action" value="loginTry" />

                <div class="mb-3">
                    <label for="login" class="form-label fw-semibold">Login</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        id="login"
                        name="login"
                        placeholder="Votre login"
                        required
                        autocomplete="username"
                        value="<?= htmlspecialchars($_POST['login'] ?? '') ?>" />
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Mot de passe</label>
                    <input
                        type="password"
                        class="form-control form-control-lg"
                        id="password"
                        name="password"
                        placeholder="Votre mot de passe"
                        required
                        autocomplete="current-password" />
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">
                    Se connecter
                </button>
            </form>

        </div>
    </div>
</div>


</html>