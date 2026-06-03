
<?php

require_once '../model/ModelUtilisateur.php';

/**
 * Controlleur Utilisateur
 */
class ControllerUtilisateur
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
}
?>
