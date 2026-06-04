
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
    public static function utilisateursReadAll()
    {
        $results = ModelUtilisateur::getAll();
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
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
            $role = $_POST['type_user'];

            $login = strtolower(str_replace(' ', '', $nom . $prenom));
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

            $result = ModelUtilisateur::insert($nom, $prenom, $role, $login, $password, $solde);


            $vue = $rootPath . '/app/view/administrateur/viewUserInserted.php';
            require($vue);
        }
    }
}
?>
