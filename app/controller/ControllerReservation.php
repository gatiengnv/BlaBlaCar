<?php

require_once '../model/ModelTrajet.php';

class ControllerReservation
{
    /**
     * Retourne les réservations de l'utilisateur connecté
     */
    public static function getUserReservation(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $loginId = (int) ($_SESSION['login_id'] ?? -1);
        $role = (string) ($_SESSION['login_role'] ?? '');

        if ($loginId === -1 || $role !== 'passager') {
            header('Location: router.php?action=menuAccueil');
            exit();
        }

        $results = ModelTrajet::getByPassagerId($loginId);

        if ($results === NULL) {
            $results = [];
        }

        include 'config.php';
        $rootPath = isset($root) ? $root : '';

        $vue = $rootPath . '/app/view/passager/viewReservations.php';
        require($vue);
    }
}
?>