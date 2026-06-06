<?php

require_once '../model/ModelVehicule.php';
require_once '../model/ModelTrajet.php';
require_once '../model/ModelVille.php';
require_once '../model/ModelReservation.php';
require_once '../model/ModelUtilisateur.php';

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
    /**
     * Affiche les passagers d'un trajet actif du conducteur.
     */
    public static function trajetPassagers(array $args = array()): void
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

        // Récupérer tous les trajets actifs du conducteur (pour le sélecteur)
        /** @var array<int, ModelTrajetEnrichi>|null $trajets */
        $trajets = ModelTrajet::getByConducteurId($loginId);
        if ($trajets === NULL) {
            $trajets = array();
        }

        // Filtrer uniquement les trajets actifs
        /** @var array<int, ModelTrajetEnrichi> $trajetsActifs */
        $trajetsActifs = array();
        foreach ($trajets as $trajet) {
            if ((string) $trajet->getStatut() === 'actif') {
                $trajetsActifs[] = $trajet;
            }
        }

        // Récupérer l'identifiant du trajet sélectionné
        /** @var int|null $trajetId */
        $trajetId = isset($args['trajet_id']) ? (int) $args['trajet_id'] : null;

        /** @var array $passagers */
        $passagers = array();

        if ($trajetId !== null) {
            // Vérifier que le trajet appartient bien au conducteur connecté
            /** @var array|null $trajetData */
            $trajetData = ModelTrajet::getOne($trajetId);
            if ($trajetData !== NULL && count($trajetData) > 0) {
                /** @var ModelTrajet $trajetObj */
                $trajetObj = $trajetData[0];
                if ((int) $trajetObj->getConducteur_id() === $loginId) {
                    // Récupérer les passagers de ce trajet
                    $passagers = ModelReservation::getPassagersByTrajetId($trajetId);
                    if ($passagers === NULL) {
                        $passagers = array();
                    }
                } else {
                    // Le trajet n'appartient pas au conducteur
                    header('Location: router.php?action=menuAccueil');
                    exit();
                }
            }
        }

        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/conducteur/viewPassagersTrajet.php';

        require($vue);
    }
    /**
     * Clôture un trajet actif du conducteur connecté.
     * Passe le trajet en statut "passif" et effectue les paiements
     * des passagers vers le conducteur.
     */
    public static function trajetCloturer(array $args = array()): void
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

        // Récupérer l'identifiant du trajet à clôturer
        /** @var int|null $trajetId */
        $trajetId = isset($args['trajet_id']) ? (int) $args['trajet_id'] : null;

        if ($trajetId === null) {
            header('Location: router.php?action=mesTrajets&erreur=trajet_invalide');
            exit();
        }

        // Récupérer le trajet
        /** @var array|null $trajetData */
        $trajetData = ModelTrajet::getOne($trajetId);
        if ($trajetData === NULL || count($trajetData) === 0) {
            header('Location: router.php?action=mesTrajets&erreur=trajet_introuvable');
            exit();
        }

        /** @var ModelTrajet $trajetObj */
        $trajetObj = $trajetData[0];

        // Vérifier que le trajet appartient au conducteur connecté
        if ((int) $trajetObj->getConducteur_id() !== $loginId) {
            header('Location: router.php?action=menuAccueil');
            exit();
        }

        // Vérifier que le trajet est bien actif
        if ((string) $trajetObj->getStatut() !== 'actif') {
            header('Location: router.php?action=mesTrajets&erreur=trajet_deja_cloture');
            exit();
        }

        /** @var float $prix */
        $prix = (float) $trajetObj->getPrix();

        // Récupérer toutes les réservations du trajet
        /** @var array|null $reservations */
        $reservations = ModelReservation::getReservationsByTrajetId($trajetId);
        if ($reservations === NULL) {
            $reservations = array();
        }

        // Récupérer le conducteur pour son solde actuel
        /** @var array|null $conducteurData */
        $conducteurData = ModelUtilisateur::getOne($loginId);
        if ($conducteurData === NULL || count($conducteurData) === 0) {
            header('Location: router.php?action=mesTrajets&erreur=erreur_paiement');
            exit();
        }
        /** @var ModelUtilisateur $conducteur */
        $conducteur = $conducteurData[0];
        /** @var float $soldeConducteur */
        $soldeConducteur = (float) $conducteur->getSolde();

        // Effectuer les paiements : chaque réservation = 1 place = 1 x prix
        foreach ($reservations as $reservation) {
            /** @var int $passagerId */
            $passagerId = (int) $reservation->getPassager_id();

            // Récupérer le passager
            /** @var array|null $passagerData */
            $passagerData = ModelUtilisateur::getOne($passagerId);
            if ($passagerData !== NULL && count($passagerData) > 0) {
                /** @var ModelUtilisateur $passager */
                $passager = $passagerData[0];
                /** @var float $soldePassager */
                $soldePassager = (float) $passager->getSolde();

                // Débiter le passager
                ModelUtilisateur::updateSolde($passagerId, $soldePassager - $prix);

                // Créditer le conducteur
                $soldeConducteur += $prix;
            }
        }

        // Mettre à jour le solde du conducteur
        ModelUtilisateur::updateSolde($loginId, $soldeConducteur);

        // Passer le trajet en statut passif
        ModelTrajet::updateStatut($trajetId, 'passif');

        // Rediriger vers la liste des trajets avec message de succès
        header('Location: router.php?action=mesTrajets&succes=trajet_cloture');
        exit();
    }
}
?>

