<?php
$rootPath = isset($rootPath) ? $rootPath : '';

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    ?>
    <div class="container">

        <h2>Réserver un trajet</h2>

        <?php if (empty($results)): ?>
            <p>Aucun trajet actif disponible.</p>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Prix</th>
                        <th>Action</th>
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
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    href="router.php?action=trajetReserved&trajet_id=<?= htmlspecialchars($trajet->getId()) ?>">
                                    Réserver
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>