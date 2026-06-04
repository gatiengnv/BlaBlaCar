<?php

require_once '../model/ModelVehicule.php';
require_once '../model/ModelTrajet.php';

/**
 * Controlleur Conducteur
 */
class ControllerConducteur
{
    /**
     * Liste des véhicules du conducteur connecté.
     */
    public static function mesVehicules(array $args = array()): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        /** @var int $loginId */
        $loginId = (int) ($_SESSION['login_id'] ?? -1);
        /** @var string $role */
        $role = (string) ($_SESSION['login_role'] ?? '');

        if ($loginId === -1 || $role !== 'conducteur') {
            header('Location: router.php?action=menuAccueil');
            exit();
        }

        /** @var array<int, ModelVehicule>|null $results */
        $results = ModelVehicule::getByProprietaireId($loginId);
        if ($results === NULL) {
            $results = array();
        }

        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/conducteur/viewVehiclesConducteur.php';

        require($vue);
    }

    /**
     * Liste de tous les trajets du conducteur connecté.
     */
    public static function mesTrajets(array $args = array()): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        /** @var int $loginId */
        $loginId = (int) ($_SESSION['login_id'] ?? -1);
        /** @var string $role */
        $role = (string) ($_SESSION['login_role'] ?? '');

        if ($loginId === -1 || $role !== 'conducteur') {
            header('Location: router.php?action=menuAccueil');
            exit();
        }

        /** @var array<int, ModelTrajetEnrichi>|null $results */
        $results = ModelTrajet::getByConducteurId($loginId);
        if ($results === NULL) {
            $results = array();
        }

        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/conducteur/viewTrajetsConducteur.php';

        require($vue);
    }
}
?>

