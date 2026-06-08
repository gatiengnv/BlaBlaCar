<?php

/** @var array<int, ModelVille> $villes */
/** @var array<int, ModelVehicule> $vehicules */
$rootPath = isset($root) ? (string) $root : '';
$villes = $villes ?? array();
$vehicules = $vehicules ?? array();
$message = isset($message) ? (string) $message : '';
$errorMessage = isset($errorMessage) ? (string) $errorMessage : '';
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php
    include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
    ?>
    <div class="container">

        <h2 class="mb-4">Créer un nouveau trajet</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($errorMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post" action="router.php">
            <input type="hidden" name="action" value="trajetCreated" />

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ville_depart" class="form-label">Ville de départ <span class="text-danger">*</span></label>
                    <select class="form-select" id="ville_depart" name="ville_depart" required>
                        <option value="">-- Sélectionner une ville --</option>
                        <?php foreach ($villes as $ville): ?>
                            <option value="<?php echo (int) $ville->getId(); ?>">
                                <?php echo htmlspecialchars((string) $ville->getNom()); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ville_arrivee" class="form-label">Ville d'arrivée <span class="text-danger">*</span></label>
                    <select class="form-select" id="ville_arrivee" name="ville_arrivee" required>
                        <option value="">-- Sélectionner une ville --</option>
                        <?php foreach ($villes as $ville): ?>
                            <option value="<?php echo (int) $ville->getId(); ?>">
                                <?php echo htmlspecialchars((string) $ville->getNom()); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="vehicule_id" class="form-label">Véhicule <span class="text-danger">*</span></label>
                <select class="form-select" id="vehicule_id" name="vehicule_id" required>
                    <option value="">-- Sélectionner un véhicule --</option>
                    <?php foreach ($vehicules as $vehicule): ?>
                        <option value="<?php echo (int) $vehicule->getId(); ?>">
                            <?php echo htmlspecialchars((string) ($vehicule->getMarque() . ' ' . $vehicule->getModele() . ' (' . $vehicule->getImmatriculation() . ')')); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="prix" class="form-label">Prix du trajet (€) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" required />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="date_depart" class="form-label">Date de départ <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="date_depart" name="date_depart" required />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="heure_depart" class="form-label">Heure de départ <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" id="heure_depart" name="heure_depart" required />
                </div>
            </div>

            <div class="mb-3">
                <small class="text-muted">
                    <span class="text-danger">*</span> = Champs obligatoires
                </small>
            </div>

            <div>
                <button type="submit" class="btn btn-success">Créer le trajet</button>
                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
            </div>
        </form>
    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>