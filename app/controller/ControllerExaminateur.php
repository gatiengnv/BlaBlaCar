<?php

require_once '../model/ModelTrajet.php';
require_once '../model/ModelReservation.php';
require_once '../model/ModelUtilisateur.php';
require_once '../model/ModelVille.php';

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

    /**
     * Crée 10 réservations aléatoires sur des trajets actifs pour des passagers aléatoires.
     */
    public static function reservationsAleatoires(array $args = array()): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        /** @var string $message */
        $message = '';
        /** @var string $errorMessage */
        $errorMessage = '';
        /** @var array $reservationsCreees */
        $reservationsCreees = array();

        // Récupérer tous les trajets actifs
        /** @var array|null $trajetsActifs */
        $trajetsActifs = ModelTrajet::getMany("SELECT * FROM trajet WHERE statut = 'actif'");
        if ($trajetsActifs === NULL || count($trajetsActifs) === 0) {
            $errorMessage = 'Aucun trajet actif disponible pour créer des réservations.';
        } else {
            // Récupérer tous les passagers
            /** @var array|null $passagers */
            $passagers = ModelUtilisateur::getMany("SELECT * FROM utilisateur WHERE role = 'passager'");
            if ($passagers === NULL || count($passagers) === 0) {
                $errorMessage = 'Aucun passager disponible pour créer des réservations.';
            } else {
                // Créer 10 réservations aléatoires
                $nbCreees = 0;
                for ($i = 0; $i < 10; $i++) {
                    // Sélectionner un trajet actif aléatoire
                    /** @var ModelTrajet $trajet */
                    $trajet = $trajetsActifs[array_rand($trajetsActifs)];
                    // Sélectionner un passager aléatoire
                    /** @var ModelUtilisateur $passager */
                    $passager = $passagers[array_rand($passagers)];

                    // Insérer la réservation
                    $result = ModelReservation::insert((int) $trajet->getId(), (int) $passager->getId());
                    if ($result !== -1) {
                        $nbCreees++;

                        // Récupérer les noms des villes
                        $villeDepart = ModelVille::getOne((int) $trajet->getVille_depart());
                        $villeArrivee = ModelVille::getOne((int) $trajet->getVille_arrivee());
                        $nomDepart = ($villeDepart !== NULL && count($villeDepart) > 0) ? $villeDepart[0]->getNom() : 'Inconnue';
                        $nomArrivee = ($villeArrivee !== NULL && count($villeArrivee) > 0) ? $villeArrivee[0]->getNom() : 'Inconnue';

                        $reservationsCreees[] = array(
                            'ville_depart' => $nomDepart,
                            'ville_arrivee' => $nomArrivee,
                            'passager_prenom' => $passager->getPrenom(),
                            'passager_nom' => $passager->getNom()
                        );
                    }
                }

                if ($nbCreees === 10) {
                    $message = '10 réservations aléatoires créées avec succès !';
                } elseif ($nbCreees > 0) {
                    $message = $nbCreees . ' réservation(s) créée(s) sur 10 (certaines ont échoué).';
                } else {
                    $errorMessage = 'Erreur : aucune réservation n\'a pu être créée.';
                }
            }
        }

        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/examinateur/viewReservationsAleatoires.php';

        require($vue);
    }
}
?>
