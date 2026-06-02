
<?php

require_once '../model/ModelUtilisateur.php';
require_once '../model/ModelVille.php';
require_once '../model/ModelVehicule.php';

/**
 * Controlleur Administrateur
 */
class ControllerAdministrateur
{

    /**
     * Liste des utilisateurs
     */
    public static function utilisateursReadAll()
    {
        $results = ModelUtilisateur::getAll();
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/viewUsers.php';

        require($vue);
    }

    /**
     * Liste des villes
     */
    public static function villesReadAll()
    {
        $results = ModelVille::getAll();
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/viewVilles.php';

        require($vue);
    }

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
}
?>
