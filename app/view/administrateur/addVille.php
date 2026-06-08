<?php
$rootPath = isset($root) ? $root : '';
$results = $results ?? [];
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    ?>
    <div class="container">
        <h2>Ajout d'une ville</h2>

        <form role="form" method='post' action='router.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='villeCreated'>
                <label class='w-25' for="nom">Nom</label><input id="ville_nom" type="text" name='ville_nom' size='75' value=''> <br />
            </div>
            <p></p>
            <br />
            <button class="btn btn-primary" type="submit">Ajouter la ville</button>
        </form>
        <p></p>
    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>