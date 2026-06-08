<?php
$rootPath = isset($rootPath) ? $rootPath : '';

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    ?>
    <div class="container">

        <?php if ($result !== -1): ?>
            <h3>Votre réservation a bien été enregistrée.</h3>
            <p>ID réservation : <?= htmlspecialchars($result) ?></p>
        <?php else: ?>
            <h3>Erreur lors de la réservation.</h3>
        <?php endif; ?>

        <a href="router.php?action=passagerReservations" class="btn btn-success">
            Voir mes réservations
        </a>
    </div>
</body>

</html>