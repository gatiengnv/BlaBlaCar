
<?php

require_once '../model/ModelUtilisateur.php';

/**
 * Controlleur Utilisateur
 */
class ControllerUtilisateur
{
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
            $_SESSION['login_name'] = (string) ($user->getNom() . ' ' . $user->getPrenom());
            $_SESSION['login_solde'] = (string) ($user->getSolde());



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
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();

        header('Location: router.php?action=menuAccueil');
        exit();
    }

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
     * Affiche le formulaire d'insertion d'un nouveau conducteur
     */
    public static function conducteurCreate()
    {
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/addConducteur.php';
        require($vue);
    }

    /**
     * Affiche le formulaire d'insertion d'un nouveau passager
     */
    public static function passagerCreate()
    {
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/addPassager.php';
        require($vue);
    }

    /**
     * Traitement du formulaire d'insertion d'un utilisateur
     */
    public static function userCreated()
    {
        if (
            isset($_POST['user_nom']) &&
            isset($_POST['user_prenom']) &&
            isset($_POST['user_solde']) &&
            isset($_POST['type_user'])
        ) {
            $nom = trim($_POST['user_nom']);
            $prenom = trim($_POST['user_prenom']);
            $solde = intval($_POST['user_solde']);
            $typeUser = $_POST['type_user'];

            // Varchar20 pour le login
            $login = strtolower(
                preg_replace('/[^a-z0-9]/', '', $nom . $prenom)
            );

            $login = substr($login, 0, 20);
            $password = "secret";

            $utilisateurs = ModelUtilisateur::getAll();

            $utilisateurExistant = null;

            foreach ($utilisateurs as $utilisateur) {
                if (strtolower($utilisateur->getLogin()) == strtolower($login)) {
                    $utilisateurExistant = $utilisateur;
                    break;
                }
            }

            include 'config.php';
            $rootPath = isset($root) ? $root : '';

            if ($utilisateurExistant !== null) {
                $message = "Impossible d'ajouter cet utilisateur : il existe déjà avec le rôle "
                    . $utilisateurExistant->getRole() . ".";

                $result = null;

                $vue = $rootPath . '/app/view/administrateur/viewUserInserted.php';
                require($vue);
                return;
            }

            $result = ModelUtilisateur::insert(
                $nom,
                $prenom,
                $typeUser,
                $login,
                $password,
                $solde
            );

            $vue = $rootPath . '/app/view/administrateur/viewUserInserted.php';
            require($vue);
        }
    }
}
?>
