<?php
$rootPath = isset($root) ? $root : '';
$result = $result ?? null;
$message = $message ?? null;

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.html';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <?php if ($message): ?>

            <h3><?= htmlspecialchars($message) ?></h3>
            <p>Login généré = <?= htmlspecialchars($login ?? '') ?></p>

        <?php elseif ($result && $result != -1): ?>

            <h3>Le nouvel utilisateur a été ajouté</h3>

            <ul>
                <li>id = <?= intval($result) ?></li>
                <li>nom = <?= htmlspecialchars($nom) ?></li>
                <li>prénom = <?= htmlspecialchars($prenom) ?></li>
                <li>login = <?= htmlspecialchars($login) ?></li>
                <li>mot de passe = secret</li>
                <li>rôle = <?= htmlspecialchars($role) ?></li>
                <li>solde = <?= htmlspecialchars($solde) ?></li>
            </ul>

        <?php else: ?>

            <h3>Problème d'insertion de l'utilisateur</h3>

        <?php endif; ?>
    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>