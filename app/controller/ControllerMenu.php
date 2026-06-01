
<!-- ----- debut ControllerMenu -->
<?php
class ControllerMenu {
 // --- page d'acceuil
 public static function menuAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewBlaBlaCarAccueil.php';
  if (DEBUG)
   echo ("ControllerMenu : menuAccueil : vue = $vue");
  require ($vue);
 }

}
?>
<!-- ----- fin menuController -->