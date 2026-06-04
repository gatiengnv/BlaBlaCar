<?php
$rootPath = isset($root) ? $root : '';
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <h2>Ajouter un passager</h2>

        <form role="form" method="post" action="router.php">
            <input type="hidden" name="action" value="userCreated">
            <input type="hidden" name="type_user" value="passager">

            <div class="mb-3">
                <label for="user_nom" class="form-label">Nom</label>
                <input id="user_nom" type="text" name="user_nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="user_prenom" class="form-label">Prénom</label>
                <input id="user_prenom" type="text" name="user_prenom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="user_solde" class="form-label">Solde</label>
                <input id="user_solde" type="number" name="user_solde" class="form-control" value="0" min="0" required>
            </div>

            <button class="btn btn-primary" type="submit">Ajouter le passager</button>
        </form>
    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>