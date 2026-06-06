<?php

/**
 * Controlleur Examinateur
 * Pages dédiées à l'examinateur pour vérifier le fonctionnement de l'application.
 */
class ControllerExaminateur
{
    /**
     * Affiche le contenu des superglobales $_COOKIE et $_SESSION.
     */
    public static function superglobales(array $args = array()): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/examinateur/viewSuperglobales.php';

        require($vue);
    }
}
?>
