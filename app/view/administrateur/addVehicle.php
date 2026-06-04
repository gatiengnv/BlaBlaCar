<?php
$rootPath = isset($root) ? $root : '';
$proprietaires = $proprietaires ?? [];

require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">

        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <h2>Ajouter un véhicule</h2>

        <form role="form" method="post" action="router.php">

            <input type="hidden" name="action" value="vehicleCreated">

            <div class="mb-3">
                <label for="vehicle_marque" class="form-label">Marque</label>
                <input
                    id="vehicle_marque"
                    type="text"
                    name="vehicle_marque"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="vehicle_modele" class="form-label">Modèle</label>
                <input
                    id="vehicle_modele"
                    type="text"
                    name="vehicle_modele"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="vehicle_annee" class="form-label">Année</label>
                <input
                    id="vehicle_annee"
                    type="number"
                    name="vehicle_annee"
                    class="form-control"
                    min="1900"
                    max="<?= date('Y') ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="vehicle_immatriculation" class="form-label">
                    Immatriculation
                </label>

                <input
                    id="vehicle_immatriculation"
                    type="text"
                    name="vehicle_immatriculation"
                    class="form-control"
                    placeholder="XX-123-XX"
                    required>
            </div>

            <div class="mb-3">
                <label for="vehicle_proprietaire" class="form-label">Propriétaire</label>

                <select
                    id="vehicle_proprietaire"
                    name="vehicle_proprietaire"
                    class="form-select"
                    required>

                    <option value="">Sélectionnez un propriétaire</option>

                    <?php foreach ($proprietaires as $proprietaire): ?>

                        <?php
                        $proprietaireId = $proprietaire->getId();

                        $proprietaireNom = htmlspecialchars(
                            $proprietaire->getNom() . ' ' . $proprietaire->getPrenom()
                        );
                        ?>

                        <option value="<?= $proprietaireId ?>">
                            <?= $proprietaireId ?> - <?= $proprietaireNom ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <button class="btn btn-primary" type="submit">
                Ajouter le véhicule
            </button>

        </form>

    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>