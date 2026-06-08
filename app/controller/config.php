
<?php

// Utile pour le débugage car c'est un interrupteur pour les echos et print_r.
if (!defined('DEBUG')) {
    define('DEBUG', FALSE);
}

// ===============
// Configuration de la base de données sur dev-isi
$dsn = 'mysql:dbname=name;host=localhost;charset=utf8';
$username = 'username';
$password = '.....';

if (!defined('LOCAL')) {
    define('LOCAL', FALSE);
}

if (!defined('DOCKER_DEV')) {
    define('DOCKER_DEV', TRUE);
}

if (LOCAL) {
    // Configuration de la base de données sur localhost
    $dsn = 'mysql:dbname=BlaBlaCar;host=localhost;charset=utf8';
    $username = 'root';
    $password = 'root';
}

if (DOCKER_DEV) {
    // Configuration de la base de données avec la config docker de dev
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=project_bdd;charset=utf8';
    $username = 'dbuser';
    $password = 'dbuser';
}

// chemin absolu vers le répertoire du projet SUR DEV-ISI
$root = dirname(dirname(__DIR__)) . "/";


if (DEBUG) {
 echo ("<ul>");
 echo (" <li>dsn = $dsn</li>");
 echo (" <li>username = $username</li>");
 echo (" <li>password = $password</li>");
 echo ("<li>---</li>");
 echo (" <li>root = $root</li>");

 echo ("</ul>");
}
?>



