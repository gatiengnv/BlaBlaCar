<?php
/** @var array<int, ModelTrajetEnrichi> $trajetsActifs */
/** @var array $passagers */
/** @var int|null $trajetId */
$rootPath = isset($root) ? (string) $root : '';
$trajetsActifs = $trajetsActifs ?? array();
$passagers = $passagers ?? array();
$trajetId = $trajetId ?? null;
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <h2 class="mb-4">Passagers de mes trajets</h2>

        <!-- Sélecteur de trajet actif -->
        <form method="get" action="router.php" class="mb-4">
            <input type="hidden" name="action" value="trajetPassagers">
            <div class="row align-items-end">
                <div class="col-md-8">
                    <label for="trajet_id" class="form-label"><strong>Sélectionnez un trajet actif :</strong></label>
                    <select name="trajet_id" id="trajet_id" class="form-select" required>
                        <option value="">-- Choisir un trajet --</option>
                        <?php foreach ($trajetsActifs as $trajet): ?>
                            <option value="<?php echo (int) $trajet->getId(); ?>"
                                <?php echo ($trajetId !== null && (int) $trajet->getId() === $trajetId) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars((string) $trajet->getNom_depart()); ?>
                                &rarr;
                                <?php echo htmlspecialchars((string) $trajet->getNom_arrivee()); ?>
                                (<?php echo htmlspecialchars((string) $trajet->getDate_depart()); ?>
                                à <?php echo htmlspecialchars((string) $trajet->getHeure_depart()); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Afficher les passagers</button>
                </div>
            </div>
        </form>

        <!-- Liste des passagers -->
        <?php if ($trajetId !== null): ?>
            <h3 class="mt-4 mb-3">
                <span class="badge bg-info">Liste des passagers</span>
            </h3>

            <?php if (count($passagers) === 0): ?>
                <div class="alert alert-warning" role="alert">Aucun passager n'a réservé ce trajet.</div>
            <?php else: ?>
                <table class="table table-striped table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($passagers as $passager): ?>
                            <tr>
                                <td><?php echo htmlspecialchars((string) $passager->getNom()); ?></td>
                                <td><?php echo htmlspecialchars((string) $passager->getPrenom()); ?></td>
                                <td><?php echo htmlspecialchars((string) $passager->getLogin()); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-muted">Nombre de passagers : <?php echo count($passagers); ?></p>
            <?php endif; ?>
        <?php endif; ?>

        <a href="router.php?action=mesTrajets" class="btn btn-secondary mt-3">Retour à mes trajets</a>
    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>
