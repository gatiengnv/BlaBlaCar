<?php
$rootPath = isset($rootPath) ? $rootPath : '';

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    ?>
    <div class="container">
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
                        <th>Conducteur</th>
                        <th>Véhicule</th>
                        <th>Immatriculation</th>
                        <th>Prix</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($results as $trajet): ?>
                        <tr>
                            <td><?= htmlspecialchars($trajet->getNom_depart()) ?></td>
                            <td><?= htmlspecialchars($trajet->getNom_arrivee()) ?></td>
                            <td><?= htmlspecialchars($trajet->getDate_depart()) ?></td>
                            <td><?= htmlspecialchars($trajet->getHeure_depart()) ?></td>
                            <td><?= htmlspecialchars($trajet->getConducteur_nom()) ?></td>
                            <td><?= htmlspecialchars($trajet->getVehicule_nom()) ?></td>
                            <td><?= htmlspecialchars($trajet->getImmatriculation()) ?></td>
                            <td><?= htmlspecialchars($trajet->getPrix()) ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>