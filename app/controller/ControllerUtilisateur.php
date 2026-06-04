
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
    public static function utilisateursReadAll(): void
    {
        /** @var ModelUtilisateur[]|null $results */
        $results = ModelUtilisateur::getAll();
        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/administrateur/viewUsers.php';

        require($vue);
    }

    /**
     * Affiche le formulaire de connexion
     */
    public static function loginForm(): void
    {
        include 'config.php';
        /** @var string $rootPath */
        $rootPath = isset($root) ? (string) $root : '';
        $vue = $rootPath . '/app/view/fragment/loginForm.php';
        require($vue);
    }

    /**
     * Traite la tentative de connexion
     */
    public static function loginTry(array $args): void
    {
        // sécuriser les entrées
        $login = htmlspecialchars((string) ($args['login'] ?? ''));
        $password = htmlspecialchars((string) ($args['password'] ?? ''));

        // simple authentification en base
        /** @var ModelUtilisateur[]|null $users */
        $users = ModelUtilisateur::getMany("select * from utilisateur where login = '" . addslashes($login) . "'");
        $ok = false;
        /** @var ModelUtilisateur|null $user */
        $user = null;
        if ($users && count($users) > 0) {
            $user = $users[0];
            // ici la table stocke probablement le mot de passe en clair (exercice) ; comparer directement
            if ($user->getPassword() === $password) {
                $ok = true;
            }
        }

        if ($ok) {
            // initialiser la session
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['login_id'] = (int) $user->getId();
            $_SESSION['login_role'] = (string) $user->getRole();
            $_SESSION['login_name'] = (string) ($user->getPrenom() . ' ' . $user->getNom());

            // rediriger vers l'accueil (le menu affichera selon le rôle)
            header('Location: router.php?action=menuAccueil');
            exit();
        } else {
            // échec : réafficher le formulaire avec message
            include 'config.php';
            /** @var string $rootPath */
            $rootPath = isset($root) ? (string) $root : '';
            $error = 'Login ou mot de passe incorrect';
            $vue = $rootPath . '/app/view/fragment/loginForm.php';
            require($vue);
        }
    }

    /**
     * Déconnexion
     */
    public static function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION = array();
        $_SESSION['login_id'] = -1;
        header('Location: router.php?action=menuAccueil');
        exit();
    }
}
?>
