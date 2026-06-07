<?php
$rootPath = isset($rootPath) ? $rootPath : '';

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
<div class="container">
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
    ?>

    <h2>Mes réservations</h2>

    <?php if (empty($results)): ?>
        <p>Vous n'avez aucune réservation.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Ville de départ</th>
                <th>Ville d'arrivée</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Prix</th>
                <th>Statut</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($results as $trajet): ?>
                <tr>
                    <td><?= htmlspecialchars($trajet->getNom_depart()) ?></td>
                    <td><?= htmlspecialchars($trajet->getNom_arrivee()) ?></td>
                    <td><?= htmlspecialchars($trajet->getDate_depart()) ?></td>
                    <td><?= htmlspecialchars($trajet->getHeure_depart()) ?></td>
                    <td><?= htmlspecialchars($trajet->getPrix()) ?> €</td>
                    <td><?= htmlspecialchars($trajet->getStatut()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>