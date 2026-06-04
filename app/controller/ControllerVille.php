
<?php

require_once '../model/ModelVille.php';

/**
 * Controlleur Ville
 */
class ControllerVille
{
    /**
     * Liste des villes
     */
    public static function villesReadAll()
    {
        $results = ModelVille::getAll();
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/viewVilles.php';

        require($vue);
    }

    /**
     * Affiche le formulaire d'insertion d'une ville
     */
    public static function villeCreate()
    {
        include 'config.php';
        $rootPath = isset($root) ? $root : '';
        $vue = $rootPath . '/app/view/administrateur/addVille.php';
        require($vue);
    }

    /**
     * Traitement du formulaire d'insertion d'une ville 
     */
    public static function villeCreated()
    {
        if (isset($_POST['ville_nom'])) {

            $nom = trim($_POST['ville_nom']);

            // on a besoin de la liste des villes afin d'éviter d'ajouter une ville qui existe déjà            
            $villes = ModelVille::getAll();

            $isVilleExist = false;

            foreach ($villes as $ville) {
                if (strtolower($ville->getNom()) == strtolower($nom)) {
                    $isVilleExist = true;
                    break;
                }
            }

            include 'config.php';
            $rootPath = isset($root) ? $root : '';

            if ($isVilleExist) {

                $message = "La ville existe déjà.";

                $vue = $rootPath . '/app/view/administrateur/viewVilleInserted.php';
                require($vue);
                return;
            } else {
                $result = ModelVille::insert($nom);
                $vue = $rootPath . '/app/view/administrateur/viewVilleInserted.php';
                require($vue);
            }
        }
    }
}
?>
