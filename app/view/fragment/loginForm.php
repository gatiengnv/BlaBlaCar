<?php
// simple login form fragment
?>
<div class="container" style="margin-top:80px; max-width:500px;">
    <h2>Connexion</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form action="router.php" method="post">
        <input type="hidden" name="action" value="loginTry" />
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" required value="<?php echo htmlspecialchars($_POST['login'] ?? ''); ?>" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <button type="submit" class="btn btn-success">Se connecter</button>
    </form>
</div>


