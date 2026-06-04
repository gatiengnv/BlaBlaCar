<?php

require('../controller/ControllerMenu.php');
require('../controller/ControllerUtilisateur.php');
require('../controller/ControllerVille.php');
require('../controller/ControllerVehicule.php');

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
    "utilisateursReadAll" => array("controller" => "ControllerUtilisateur", "method" => "utilisateursReadAll"),
    "conducteurCreate" => array("controller" => "ControllerUtilisateur", "method" => "conducteurCreate"),
    "passagerCreate" => array("controller" => "ControllerUtilisateur", "method" => "passagerCreate"),
    "userCreated" => array("controller" => "ControllerUtilisateur", "method" => "userCreated"),

    // Ville
    "villeCreate" => array("controller" => "ControllerVille", "method" => "villeCreate"),
    "villeCreated" => array("controller" => "ControllerVille", "method" => "villeCreated"),
    "villesReadAll" => array("controller" => "ControllerVille", "method" => "villesReadAll"),

    // Vehicules
    "vehiculesReadAll" => array("controller" => "ControllerVehicule", "method" => "vehiculesReadAll"),
    "vehicleCreate" => array("controller" => "ControllerVehicule", "method" => "vehicleCreate"),
    "vehicleCreated" => array("controller" => "ControllerVehicule", "method" => "vehicleCreated"),
);

/** Tache par defaut */
if (!array_key_exists($action, $allowed_actions)) {
    $action = "menuAccueil";
}

$route = $allowed_actions[$action];
$controller = $route["controller"];
$method = $route["method"];

$controller::$method($args);
