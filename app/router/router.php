<?php
session_start();
if (!isset($_SESSION['login_id'])) {
    $_SESSION['login_id'] = -1;
}

require('../controller/ControllerMenu.php');
require('../controller/ControllerUtilisateur.php');
require('../controller/ControllerConducteur.php');
require('../controller/ControllerVille.php');
require('../controller/ControllerVehicule.php');
require('../controller/ControllerExaminateur.php');

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
    "mesVehicules" => array("controller" => "ControllerConducteur", "method" => "mesVehicules"),
    "mesTrajets" => array("controller" => "ControllerConducteur", "method" => "mesTrajets"),
    "trajetCreate" => array("controller" => "ControllerConducteur", "method" => "trajetCreate"),
    "trajetCreated" => array("controller" => "ControllerConducteur", "method" => "trajetCreated"),
    "trajetPassagers" => array("controller" => "ControllerConducteur", "method" => "trajetPassagers"),
    "trajetCloturer" => array("controller" => "ControllerConducteur", "method" => "trajetCloturer"),
    "vehicleCreate" => array("controller" => "ControllerVehicule", "method" => "vehicleCreate"),
    "vehicleCreated" => array("controller" => "ControllerVehicule", "method" => "vehicleCreated"),
    // Examinateur
    "examinateurSuperglobales" => array("controller" => "ControllerExaminateur", "method" => "superglobales"),

    // Auth
    "loginForm" => array("controller" => "ControllerUtilisateur", "method" => "loginForm"),
    "loginTry" => array("controller" => "ControllerUtilisateur", "method" => "loginTry"),
    "logout" => array("controller" => "ControllerUtilisateur", "method" => "logout"),
);

/** Tache par defaut */
if (!array_key_exists($action, $allowed_actions)) {
    $action = "menuAccueil";
}

$route = $allowed_actions[$action];
$controller = $route["controller"];
$method = $route["method"];

$controller::$method($args);
