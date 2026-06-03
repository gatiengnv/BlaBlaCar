
<?php

require_once '../model/ModelVehicule.php';

/**
 * Controlleur Vehicule
 */
class ControllerVehicule
{
    /**
     * Liste des véhicules
     */
    public static function vehiculesReadAll()
    {
        $results = ModelVehicule::getAll();
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/viewVehicles.php';

        require($vue);
    }

    /**
     * Affiche le formulaire d'insertion d'un véhicule
     */
    public static function vehicleCreate()
    {
        $proprietaires = ModelUtilisateur::getAll();

        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/addVehicle.php';
        require($vue);
    }

    /**
     * Traitement du formulaire d'insertion d'un véhicule 
     */
    public static function vehicleCreated()
    {
        if (isset($_POST['vehicle_marque']) && isset($_POST['vehicle_modele']) && isset($_POST['vehicle_annee']) && isset($_POST['vehicle_immatriculation']) && isset($_POST['vehicle_proprietaire'])) {
            $marque = trim($_POST['vehicle_marque']);
            $modele = trim($_POST['vehicle_modele']);
            $annee = intval($_POST['vehicle_annee']);
            $immatriculation = trim($_POST['vehicle_immatriculation']);
            $proprietaire_id = intval($_POST['vehicle_proprietaire']);

            // Vérifier si l'immatriculation existe déjà
            $vehicules = ModelVehicule::getAll();

            $isVehicleExist = false;

            foreach ($vehicules as $vehicule) {
                if (strtolower($vehicule->getImmatriculation()) == strtolower($immatriculation)) {
                    $isVehicleExist = true;
                    break;
                }
            }

            include 'config.php';
            $rootPath = isset($root) ? $root : '';

            if ($isVehicleExist) {
                $message = "Un véhicule avec cette immatriculation existe déjà.";

                $vue = $rootPath . '/app/view/administrateur/viewVehicleInserted.php';
                require($vue);
                return;
            }

            $result = ModelVehicule::insert($marque, $modele, $annee, $immatriculation, $proprietaire_id);

            $vue = $rootPath . '/app/view/administrateur/viewVehicleInserted.php';
            require($vue);
        }
    }
}
?>
