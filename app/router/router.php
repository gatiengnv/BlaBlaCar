<?php

require('../controller/ControllerMenu.php');
require('../controller/ControllerAdministrateur.php');

/** récupération de l'action passée dans l'URL */
$query_string = $_SERVER['QUERY_STRING'];

/** 
 * Permet de construire une table de hachage (clé + valeur) 
 */
parse_str((string)($_SERVER['QUERY_STRING'] ?? ''), $param);
$action = htmlspecialchars($_POST['action'] ?? ($param['action'] ?? ''));

/**
 * Préparation de la structure $args contenant tous les paramètres
 * Fusion des paramètres GET et POST
 */
$args = array_merge($param, $_POST);

/** Suppression de la clé 'action' des paramètres pour éviter les doublons */
unset($args['action']);

/** Liste blanche des actions autorisees */
$allowed_actions = array(
    // Menu
    "menuAccueil" => array("controller" => "ControllerMenu", "method" => "menuAccueil"),

    // Administateur
    "utilisateursReadAll" => array("controller" => "ControllerAdministrateur", "method" => "utilisateursReadAll"),
    "villesReadAll" => array("controller" => "ControllerAdministrateur", "method" => "villesReadAll"),
    "vehiculesReadAll" => array("controller" => "ControllerAdministrateur", "method" => "vehiculesReadAll"),
);

/** Tache par defaut */ 
if (!array_key_exists($action, $allowed_actions)) {
    $action = "menuAccueil";
}

$route = $allowed_actions[$action];
$controller = $route["controller"];
$method = $route["method"];

$controller::$method($args);
?>
