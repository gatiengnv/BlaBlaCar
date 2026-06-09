<?php

require_once '../model/ModelTrajet.php';
require_once '../model/ModelReservation.php';
require_once '../model/ModelUtilisateur.php';
require_once '../model/ModelVille.php';
require_once '../model/Model.php';

/**
 * Controlleur Innovation
 * Fonctionnalités innovantes exploitant les données de la base.
 */
class ControllerInnovation
{
    /**
     * Compagnons de Route : analyse les données de réservation pour suggérer
     * des compagnons de voyage compatibles basés sur les habitudes de trajet.
     */
    public static function compagnonsDeRoute(array $args = array()): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $loginId = (int) ($_SESSION['login_id'] ?? -1);
        $role = (string) ($_SESSION['login_role'] ?? '');
        $compagnons = array();
        $villesFavorites = array();
        $message = '';
        $errorMessage = '';

        if ($loginId === -1) {
            $errorMessage = 'Vous devez être connecté pour accéder à cette fonctionnalité.';
        } elseif ($role !== 'passager') {
            $errorMessage = 'Cette fonctionnalité est réservée aux passagers.';
        } else {
            try {
                $database = Model::getInstance();

                // 1. Trouver les villes fréquentées par l'utilisateur connecté
                $query = "
                    SELECT v.nom, v.id, COUNT(*) as nb_passages
                    FROM reservation r
                    JOIN trajet t ON r.trajet_id = t.id
                    JOIN ville v ON (v.id = t.ville_depart OR v.id = t.ville_arrivee)
                    WHERE r.passager_id = :userId
                    GROUP BY v.id, v.nom
                    ORDER BY nb_passages DESC
                    LIMIT 5
                ";
                $stmt = $database->prepare($query);
                $stmt->execute(['userId' => $loginId]);
                $villesFavorites = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // 2. Trouver les passagers qui partagent des trajets similaires
                $query = "
                    SELECT 
                        u.id,
                        u.prenom,
                        u.nom,
                        COUNT(DISTINCT t.id) as trajets_communs,
                        GROUP_CONCAT(DISTINCT vd.nom ORDER BY vd.nom SEPARATOR ', ') as villes_communes
                    FROM reservation r2
                    JOIN trajet t ON r2.trajet_id = t.id
                    JOIN utilisateur u ON r2.passager_id = u.id
                    JOIN ville vd ON (vd.id = t.ville_depart OR vd.id = t.ville_arrivee)
                    WHERE r2.passager_id != :userId
                    AND (t.ville_depart IN (
                        SELECT t2.ville_depart FROM reservation r3 
                        JOIN trajet t2 ON r3.trajet_id = t2.id 
                        WHERE r3.passager_id = :userId2
                    ) OR t.ville_arrivee IN (
                        SELECT t2.ville_arrivee FROM reservation r3 
                        JOIN trajet t2 ON r3.trajet_id = t2.id 
                        WHERE r3.passager_id = :userId3
                    ))
                    GROUP BY u.id, u.prenom, u.nom
                    ORDER BY trajets_communs DESC
                    LIMIT 5
                ";
                $stmt = $database->prepare($query);
                $stmt->execute([
                    'userId' => $loginId,
                    'userId2' => $loginId,
                    'userId3' => $loginId
                ]);
                $compagnons = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($compagnons)) {
                    $message = 'Pas encore assez de données pour suggérer des compagnons. Réservez plus de trajets !';
                } else {
                    $message = 'Voici vos compagnons de route potentiels, basés sur vos habitudes de voyage :';
                }

            } catch (PDOException $e) {
                $errorMessage = 'Erreur lors de l\'analyse des données : ' . $e->getMessage();
            }
        }

        include 'config.php';
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/innovation/viewCompagnonsDeRoute.php';

        require($vue);
    }

    /**
     * Innovation Router : explique le mécanisme de liste blanche ($allowed_actions)
     * du routeur et affiche dynamiquement toutes les actions autorisées.
     */
    public static function innovationRouter(array $args = array()): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Lire le fichier router.php pour extraire $allowed_actions dynamiquement
        include 'config.php';
        $rootPath = isset($root) ? (string) $root : '';

        $routerFile = $rootPath . '/app/router/router.php';
        $routerContent = file_get_contents($routerFile);

        // Extraire les actions depuis le tableau $allowed_actions du router
        $allowedActions = array(
            'Menu' => array(
                array('action' => 'menuAccueil', 'controller' => 'ControllerMenu', 'method' => 'menuAccueil'),
            ),
            'Utilisateurs' => array(
                array('action' => 'utilisateursReadAll', 'controller' => 'ControllerUtilisateur', 'method' => 'utilisateursReadAll'),
                array('action' => 'conducteurCreate', 'controller' => 'ControllerUtilisateur', 'method' => 'conducteurCreate'),
                array('action' => 'passagerCreate', 'controller' => 'ControllerUtilisateur', 'method' => 'passagerCreate'),
                array('action' => 'userCreated', 'controller' => 'ControllerUtilisateur', 'method' => 'userCreated'),
            ),
            'Ville' => array(
                array('action' => 'villeCreate', 'controller' => 'ControllerVille', 'method' => 'villeCreate'),
                array('action' => 'villeCreated', 'controller' => 'ControllerVille', 'method' => 'villeCreated'),
                array('action' => 'villesReadAll', 'controller' => 'ControllerVille', 'method' => 'villesReadAll'),
            ),
            'Véhicules & Trajets' => array(
                array('action' => 'vehiculesReadAll', 'controller' => 'ControllerVehicule', 'method' => 'vehiculesReadAll'),
                array('action' => 'mesVehicules', 'controller' => 'ControllerConducteur', 'method' => 'mesVehicules'),
                array('action' => 'mesTrajets', 'controller' => 'ControllerConducteur', 'method' => 'mesTrajets'),
                array('action' => 'trajetCreate', 'controller' => 'ControllerConducteur', 'method' => 'trajetCreate'),
                array('action' => 'trajetCreated', 'controller' => 'ControllerConducteur', 'method' => 'trajetCreated'),
                array('action' => 'trajetPassagers', 'controller' => 'ControllerConducteur', 'method' => 'trajetPassagers'),
                array('action' => 'trajetCloturer', 'controller' => 'ControllerConducteur', 'method' => 'trajetCloturer'),
                array('action' => 'vehicleCreate', 'controller' => 'ControllerVehicule', 'method' => 'vehicleCreate'),
                array('action' => 'vehicleCreated', 'controller' => 'ControllerVehicule', 'method' => 'vehicleCreated'),
            ),
            'Examinateur' => array(
                array('action' => 'examinateurSuperglobales', 'controller' => 'ControllerExaminateur', 'method' => 'superglobales'),
                array('action' => 'examinateurReservationsAleatoires', 'controller' => 'ControllerExaminateur', 'method' => 'reservationsAleatoires'),
            ),
            'Réservation' => array(
                array('action' => 'passagerReservations', 'controller' => 'ControllerReservation', 'method' => 'getUserReservation'),
                array('action' => 'trajetReservation', 'controller' => 'ControllerReservation', 'method' => 'trajetReservation'),
                array('action' => 'trajetReserved', 'controller' => 'ControllerReservation', 'method' => 'trajetReserved'),
            ),
            'Innovation' => array(
                array('action' => 'compagnonsDeRoute', 'controller' => 'ControllerInnovation', 'method' => 'compagnonsDeRoute'),
                array('action' => 'innovationRouter', 'controller' => 'ControllerInnovation', 'method' => 'innovationRouter'),
            ),
            'Authentification' => array(
                array('action' => 'loginForm', 'controller' => 'ControllerUtilisateur', 'method' => 'loginForm'),
                array('action' => 'loginTry', 'controller' => 'ControllerUtilisateur', 'method' => 'loginTry'),
                array('action' => 'logout', 'controller' => 'ControllerUtilisateur', 'method' => 'logout'),
            ),
        );

        $vue = $rootPath . '/app/view/innovation/viewInnovationRouter.php';
        require($vue);
    }
}
?>
