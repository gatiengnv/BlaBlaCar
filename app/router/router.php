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

    // Utilisateurs
    "utilisateursReadAll" => array("controller" => "ControllerAdministrateur", "method" => "utilisateursReadAll"),
    
    // Ville
    "villeCreate" => array("controller" => "ControllerAdministrateur", "method" => "villeCreate"),
    "villeCreated" => array("controller" => "ControllerAdministrateur", "method" => "villeCreated"),
    "villesReadAll" => array("controller" => "ControllerAdministrateur", "method" => "villesReadAll"),

    // Vehicules
    "vehiculesReadAll" => array("controller" => "ControllerAdministrateur", "method" => "vehiculesReadAll"),
    "vehicleCreate" => array("controller" => "ControllerAdministrateur", "method" => "vehicleCreate"),
    "vehicleCreated" => array("controller" => "ControllerAdministrateur", "method" => "vehicleCreated"),
);

/** Tache par defaut */
if (!array_key_exists($action, $allowed_actions)) {
    $action = "menuAccueil";
}

$route = $allowed_actions[$action];
$controller = $route["controller"];
$method = $route["method"];

$controller::$method($args);
