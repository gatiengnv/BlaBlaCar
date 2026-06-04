<?php
$rootPath = isset($root) ? $root : '';
$result = $result ?? null;
$message = $message ?? null;

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <?php

        if ($message) {

            echo "<h3>$message</h3>";
            echo "Nom de la ville = " . htmlspecialchars($_POST['ville_nom']);
        } elseif ($result && $result != -1) {

            echo "<h3>La nouvelle ville a été ajoutée</h3>";
            echo "<ul>";
            echo "<li>id = " . intval($result) . "</li>";
            echo "<li>nom = " . htmlspecialchars($_POST['ville_nom']) . "</li>";
            echo "</ul>";
        } else {

            echo "<h3>Problème d'insertion de la ville</h3>";
        }

        ?>

    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>