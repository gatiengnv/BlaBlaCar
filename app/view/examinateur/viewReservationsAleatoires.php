<?php
$rootPath = isset($root) ? (string) $root : '';
$message = $message ?? '';
$errorMessage = $errorMessage ?? '';
$reservationsCreees = $reservationsCreees ?? array();
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    ?>
    <div class="container">

        <h2 class="mb-4">E2 - Ajout de 10 réservations aléatoires</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>

        <?php if (count($reservationsCreees) > 0): ?>
            <ol class="list-group list-group-numbered mt-4">
                <?php foreach ($reservationsCreees as $resa): ?>
                    <li class="list-group-item">
                        Nouvelle réservation sur le trajet
                        <strong><?php echo htmlspecialchars(strtolower((string) $resa['ville_depart'])); ?></strong>
                        &rarr;
                        <strong><?php echo htmlspecialchars(strtolower((string) $resa['ville_arrivee'])); ?></strong>
                        par
                        <strong><?php echo htmlspecialchars((string) $resa['passager_prenom'] . ' ' . strtoupper((string) $resa['passager_nom'])); ?></strong>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

        <a href="router.php?action=examinateurReservationsAleatoires" class="btn btn-primary mt-4">Générer 10 nouvelles réservations</a>

    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>