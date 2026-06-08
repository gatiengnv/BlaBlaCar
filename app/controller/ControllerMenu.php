
<?php

require_once '../model/ModelReservation.php';
class ControllerMenu {

/**
 * Page d'accueil de l'application
 */
 public static function menuAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewBlaBlaCarAccueil.php';
  if (DEBUG)
   echo ("ControllerMenu : menuAccueil : vue = $vue");
  require ($vue);
 }

}
?>