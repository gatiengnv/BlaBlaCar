<?php
$rootPath = isset($root) ? $root : '';
$result = $result ?? null;
$message = $message ?? null;

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    ?>
    <div class="container">

        <?php if ($message): ?>

            <h3><?= htmlspecialchars($message) ?></h3>
            <p>Immatriculation = <?= htmlspecialchars($_POST['vehicle_immatriculation']) ?></p>

        <?php elseif ($result && $result != -1): ?>

            <h3>Le nouveau véhicule a été ajouté</h3>

            <ul>
                <li>id = <?= intval($result) ?></li>
                <li>marque = <?= htmlspecialchars($_POST['vehicle_marque']) ?></li>
                <li>modèle = <?= htmlspecialchars($_POST['vehicle_modele']) ?></li>
                <li>année = <?= htmlspecialchars($_POST['vehicle_annee']) ?></li>
                <li>immatriculation = <?= htmlspecialchars($_POST['vehicle_immatriculation']) ?></li>
                <li>propriétaire id = <?= htmlspecialchars($_POST['vehicle_proprietaire']) ?></li>
            </ul>

        <?php else: ?>

            <h3>Problème d'insertion du véhicule</h3>
            <p>Immatriculation = <?= htmlspecialchars($_POST['vehicle_immatriculation'] ?? '') ?></p>

        <?php endif; ?>

    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>