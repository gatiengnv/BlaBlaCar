<?php
/** @var array<int, ModelVehicule> $results */
$rootPath = isset($root) ? (string) $root : '';
$results = $results ?? array();
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <h2 class="mb-4">Mes véhicules</h2>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Année</th>
                    <th scope="col">Immatriculation</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($results) === 0): ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucun véhicule à afficher.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($results as $element): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $element->getMarque()); ?></td>
                            <td><?php echo htmlspecialchars((string) $element->getModele()); ?></td>
                            <td><?php echo (int) $element->getAnnee(); ?></td>
                            <td><?php echo htmlspecialchars((string) $element->getImmatriculation()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>



