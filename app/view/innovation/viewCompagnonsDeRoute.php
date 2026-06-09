<?php
$rootPath = isset($root) ? (string) $root : '';
$message = $message ?? '';
$errorMessage = $errorMessage ?? '';
$compagnons = $compagnons ?? array();
$villesFavorites = $villesFavorites ?? array();
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php'; ?>

    <div class="container py-4">

        <div class="text-center mb-4">
            <h2><i class="bi bi-people-fill text-success me-2"></i>Compagnons de Route</h2>
            <p class="text-muted">
                Découvrez les voyageurs qui partagent vos habitudes de trajet grâce à l'analyse intelligente de vos données de réservation.
            </p>
        </div>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo htmlspecialchars($errorMessage); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i><?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($villesFavorites)): ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-geo-alt-fill me-2"></i>Vos villes favorites (basé sur vos réservations)
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <?php foreach ($villesFavorites as $ville): ?>
                            <span class="badge bg-success bg-opacity-75 fs-6 px-3 py-2">
                                <i class="bi bi-pin-map-fill me-1"></i>
                                <?php echo htmlspecialchars(ucfirst($ville['nom'])); ?>
                                <span class="badge bg-light text-success ms-1"><?php echo (int) $ville['nb_passages']; ?> trajet(s)</span>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($compagnons)): ?>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-person-hearts me-2"></i>Compagnons suggérés
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="bi bi-person-fill me-1"></i>Voyageur</th>
                                    <th><i class="bi bi-arrow-left-right me-1"></i>Trajets en commun</th>
                                    <th><i class="bi bi-building me-1"></i>Villes partagées</th>
                                    <th><i class="bi bi-star-fill me-1"></i>Compatibilité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($compagnons as $compagnon): ?>
                                    <?php
                                    $score = min(100, (int) $compagnon['trajets_communs'] * 20);
                                    $badgeClass = $score >= 80 ? 'bg-success' : ($score >= 50 ? 'bg-warning text-dark' : 'bg-secondary');
                                    ?>
                                    <tr>
                                        <td>
                                            <i class="bi bi-person-circle me-2 text-success"></i>
                                            <strong><?php echo htmlspecialchars($compagnon['prenom'] . ' ' . strtoupper($compagnon['nom'])); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary rounded-pill"><?php echo (int) $compagnon['trajets_communs']; ?></span>
                                        </td>
                                        <td>
                                            <small class="text-muted"><?php echo htmlspecialchars($compagnon['villes_communes']); ?></small>
                                        </td>
                                        <td>
                                            <div class="progress" style="width: 100px; height: 20px;">
                                                <div class="progress-bar <?php echo $badgeClass; ?>" role="progressbar"
                                                    style="width: <?php echo $score; ?>%"
                                                    aria-valuenow="<?php echo $score; ?>" aria-valuemin="0" aria-valuemax="100">
                                                    <?php echo $score; ?>%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body text-center">
                <h5 class="card-title"><i class="bi bi-lightbulb-fill text-warning me-2"></i>Comment ça marche ?</h5>
                <p class="card-text text-muted">
                    Notre algorithme analyse vos réservations passées pour identifier les voyageurs 
                    qui empruntent des itinéraires similaires aux vôtres. Plus vous partagez de villes 
                    et de trajets en commun, plus le score de compatibilité est élevé. 
                    Voyagez ensemble pour partager les frais et rendre le trajet plus convivial !
                </p>
            </div>
        </div>

    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>
