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

    /**
     * Affiche les trajets qui sont possibles d'être réservé (status actif)
     */
    public static function trajetReservation(): void
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

        $results = ModelTrajet::getAllActifs();

        if ($results === NULL) {
            $results = [];
        }

        include 'config.php';
        $rootPath = isset($root) ? $root : '';

        $vue = $rootPath . '/app/view/passager/viewTrajetsReservation.php';
        require($vue);
    }

    /**
     * Confirmation de la réservation
     */
    public static function trajetReserved(): void
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

        $trajetId = (int) ($_GET['trajet_id'] ?? -1);

        if ($trajetId === -1) {
            header('Location: router.php?action=trajetReservation');
            exit();
        }

        $result = ModelReservation::insert($trajetId, $loginId);

        include 'config.php';
        $rootPath = isset($root) ? $root : '';

        $vue = $rootPath . '/app/view/passager/viewTrajetReserved.php';
        require($vue);
    }
}
