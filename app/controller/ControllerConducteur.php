<?php

require_once '../model/ModelVehicule.php';
require_once '../model/ModelTrajet.php';
require_once '../model/ModelVille.php';

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

    /**
     * Affiche le formulaire de création d'un trajet.
     */
    public static function trajetCreate(array $args = array()): void
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

        // Récupérer les villes et les véhicules du conducteur
        /** @var array<int, ModelVille>|null $villes */
        $villes = ModelVille::getAll();
        if ($villes === NULL) {
            $villes = array();
        }

        /** @var array<int, ModelVehicule>|null $vehicules */
        $vehicules = ModelVehicule::getByProprietaireId($loginId);
        if ($vehicules === NULL) {
            $vehicules = array();
        }

        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/conducteur/addTrajet.php';

        require($vue);
    }

    /**
     * Traite la soumission du formulaire de création de trajet.
     */
    public static function trajetCreated(array $args = array()): void
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

        /** @var string $errorMessage */
        $errorMessage = '';
        /** @var string $message */
        $message = '';

        // Vérifier que tous les champs obligatoires sont présents
        if (!isset($_POST['ville_depart'], $_POST['ville_arrivee'], $_POST['vehicule_id'], $_POST['prix'], $_POST['date_depart'], $_POST['heure_depart'])) {
            $errorMessage = 'Tous les champs sont obligatoires.';
        } else {
            /** @var int $villeDepart */
            $villeDepart = (int) $_POST['ville_depart'];
            /** @var int $villeArrivee */
            $villeArrivee = (int) $_POST['ville_arrivee'];
            /** @var int $vehiculeId */
            $vehiculeId = (int) $_POST['vehicule_id'];
            /** @var float $prix */
            $prix = (float) $_POST['prix'];
            /** @var string $dateDepart */
            $dateDepart = trim((string) $_POST['date_depart']);
            /** @var string $heureDepart */
            $heureDepart = trim((string) $_POST['heure_depart']);

            // Vérifier que les villes sont différentes
            if ($villeDepart === $villeArrivee) {
                $errorMessage = 'La ville de départ et d\'arrivée doivent être différentes.';
            } elseif ($prix <= 0) {
                $errorMessage = 'Le prix doit être supérieur à 0.';
            } elseif (empty($dateDepart) || empty($heureDepart)) {
                $errorMessage = 'La date et l\'heure de départ doivent être complétées.';
            } else {
                // Insérer le trajet avec le statut "actif"
                /** @var int $result */
                $result = ModelTrajet::insert(
                    $villeDepart,
                    $villeArrivee,
                    $loginId,
                    $vehiculeId,
                    $prix,
                    $dateDepart,
                    $heureDepart,
                    'actif'
                );

                if ($result !== -1) {
                    $message = 'Trajet créé avec succès !';
                } else {
                    $errorMessage = 'Erreur lors de la création du trajet.';
                }
            }
        }

        // Récupérer les villes et les véhicules pour le réaffichage
        /** @var array<int, ModelVille>|null $villes */
        $villes = ModelVille::getAll();
        if ($villes === NULL) {
            $villes = array();
        }

        /** @var array<int, ModelVehicule>|null $vehicules */
        $vehicules = ModelVehicule::getByProprietaireId($loginId);
        if ($vehicules === NULL) {
            $vehicules = array();
        }

        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/conducteur/addTrajet.php';

        require($vue);
    }
}
?>

