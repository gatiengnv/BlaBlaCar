<?php
/** @var array<int, ModelTrajetEnrichi> $results */
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

        <h2 class="mb-4">Mes trajets</h2>

        <?php if (isset($_GET['succes']) && $_GET['succes'] === 'trajet_cloture'): ?>
            <div class="alert alert-success" role="alert">Le trajet a été clôturé avec succès. Les paiements ont été effectués.</div>
        <?php endif; ?>

        <?php if (isset($_GET['erreur'])): ?>
            <?php
            $msgErreur = '';
            switch ($_GET['erreur']) {
                case 'trajet_invalide':
                    $msgErreur = 'Trajet invalide.';
                    break;
                case 'trajet_introuvable':
                    $msgErreur = 'Trajet introuvable.';
                    break;
                case 'trajet_deja_cloture':
                    $msgErreur = 'Ce trajet est déjà clôturé.';
                    break;
                case 'erreur_paiement':
                    $msgErreur = 'Erreur lors du traitement des paiements.';
                    break;
                default:
                    $msgErreur = 'Une erreur est survenue.';
            }
            ?>
            <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($msgErreur); ?></div>
        <?php endif; ?>

        <?php
        /** @var array<int, ModelTrajetEnrichi> $trajetsActifs */
        $trajetsActifs = array();
        /** @var array<int, ModelTrajetEnrichi> $trajetsPassifs */
        $trajetsPassifs = array();

        foreach ($results as $trajet) {
            /** @var string $statut */
            $statut = (string) $trajet->getStatut();
            if ($statut === 'actif') {
                $trajetsActifs[] = $trajet;
            } else {
                $trajetsPassifs[] = $trajet;
            }
        }
        ?>

        <!-- Trajets Actifs -->
        <h3 class="mt-4 mb-3">
            <span class="badge bg-success">Trajets Actifs</span>
        </h3>

        <?php if (count($trajetsActifs) === 0): ?>
            <div class="alert alert-info" role="alert">Aucun trajet actif pour le moment.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead class="table-success">
                    <tr>
                        <th scope="col">Ville de départ</th>
                        <th scope="col">Ville d'arrivée</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trajetsActifs as $trajet): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $trajet->getNom_depart()); ?></td>
                            <td><?php echo htmlspecialchars((string) $trajet->getNom_arrivee()); ?></td>
                            <td><?php echo htmlspecialchars((string) $trajet->getDate_depart()); ?></td>
                            <td><?php echo htmlspecialchars((string) $trajet->getHeure_depart()); ?></td>
                            <td><?php echo number_format((float) $trajet->getPrix(), 2, ',', ' '); ?> €</td>
                            <td>
                                <a href="router.php?action=trajetPassagers&trajet_id=<?php echo (int) $trajet->getId(); ?>" class="btn btn-sm btn-primary">Voir passagers</a>
                                <a href="router.php?action=trajetCloturer&trajet_id=<?php echo (int) $trajet->getId(); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir clôturer ce trajet ? Les paiements seront effectués.');">Clôturer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Trajets Passifs -->
        <h3 class="mt-5 mb-3">
            <span class="badge bg-secondary">Trajets Passifs</span>
        </h3>

        <?php if (count($trajetsPassifs) === 0): ?>
            <div class="alert alert-info" role="alert">Aucun trajet passif à afficher.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">Ville de départ</th>
                        <th scope="col">Ville d'arrivée</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure</th>
                        <th scope="col">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trajetsPassifs as $trajet): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $trajet->getNom_depart()); ?></td>
                            <td><?php echo htmlspecialchars((string) $trajet->getNom_arrivee()); ?></td>
                            <td><?php echo htmlspecialchars((string) $trajet->getDate_depart()); ?></td>
                            <td><?php echo htmlspecialchars((string) $trajet->getHeure_depart()); ?></td>
                            <td><?php echo number_format((float) $trajet->getPrix(), 2, ',', ' '); ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>


