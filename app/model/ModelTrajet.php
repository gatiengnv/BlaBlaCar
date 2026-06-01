<!-- ----- debut ModelTrajet -->

<?php
require_once __DIR__ . '/Model.php';

class ModelTrajet {
 private $id, $ville_depart, $ville_arrivee, $conducteur_id, $vehicule_id, $prix, $date_depart, $heure_depart, $statut;

 public function __construct($id = NULL, $ville_depart = NULL, $ville_arrivee = NULL, $conducteur_id = NULL, $vehicule_id = NULL, $prix = NULL, $date_depart = NULL, $heure_depart = NULL, $statut = NULL) {
  if (!is_null($id)) {
   $this->id = $id;
   $this->ville_depart = $ville_depart;
   $this->ville_arrivee = $ville_arrivee;
   $this->conducteur_id = $conducteur_id;
   $this->vehicule_id = $vehicule_id;
   $this->prix = $prix;
   $this->date_depart = $date_depart;
   $this->heure_depart = $heure_depart;
   $this->statut = $statut;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setVille_depart($ville_depart) {
  $this->ville_depart = $ville_depart;
 }

 function setVille_arrivee($ville_arrivee) {
  $this->ville_arrivee = $ville_arrivee;
 }

 function setConducteur_id($conducteur_id) {
  $this->conducteur_id = $conducteur_id;
 }

 function setVehicule_id($vehicule_id) {
  $this->vehicule_id = $vehicule_id;
 }

 function setPrix($prix) {
  $this->prix = $prix;
 }

 function setDate_depart($date_depart) {
  $this->date_depart = $date_depart;
 }

 function setHeure_depart($heure_depart) {
  $this->heure_depart = $heure_depart;
 }

 function setStatut($statut) {
  $this->statut = $statut;
 }

 function getId() {
  return $this->id;
 }

 function getVille_depart() {
  return $this->ville_depart;
 }

 function getVille_arrivee() {
  return $this->ville_arrivee;
 }

 function getConducteur_id() {
  return $this->conducteur_id;
 }

 function getVehicule_id() {
  return $this->vehicule_id;
 }

 function getPrix() {
  return $this->prix;
 }

 function getDate_depart() {
  return $this->date_depart;
 }

 function getHeure_depart() {
  return $this->heure_depart;
 }

 function getStatut() {
  return $this->statut;
 }

 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from trajet";
   $statement = $database->prepare($query);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $statement = $database->prepare($query);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajet");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from trajet";
   $statement = $database->prepare($query);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajet");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from trajet where id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajet");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($ville_depart, $ville_arrivee, $conducteur_id, $vehicule_id, $prix, $date_depart, $heure_depart, $statut) {
  try {
   $database = Model::getInstance();
   $query = "select max(id) from trajet";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   $query = "insert into trajet (id, ville_depart, ville_arrivee, conducteur_id, vehicule_id, prix, date_depart, heure_depart, statut) values (:id, :ville_depart, :ville_arrivee, :conducteur_id, :vehicule_id, :prix, :date_depart, :heure_depart, :statut)";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'ville_depart' => $ville_depart,
    'ville_arrivee' => $ville_arrivee,
    'conducteur_id' => $conducteur_id,
    'vehicule_id' => $vehicule_id,
    'prix' => $prix,
    'date_depart' => $date_depart,
    'heure_depart' => $heure_depart,
    'statut' => $statut
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($id, $ville_depart, $ville_arrivee, $conducteur_id, $vehicule_id, $prix, $date_depart, $heure_depart, $statut) {
  try {
   $database = Model::getInstance();
   $query = "update trajet set ville_depart = :ville_depart, ville_arrivee = :ville_arrivee, conducteur_id = :conducteur_id, vehicule_id = :vehicule_id, prix = :prix, date_depart = :date_depart, heure_depart = :heure_depart, statut = :statut where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'ville_depart' => $ville_depart,
    'ville_arrivee' => $ville_arrivee,
    'conducteur_id' => $conducteur_id,
    'vehicule_id' => $vehicule_id,
    'prix' => $prix,
    'date_depart' => $date_depart,
    'heure_depart' => $heure_depart,
    'statut' => $statut
   ]);
   return $statement->rowCount();
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function delete($id) {
  try {
   $database = Model::getInstance();

   $query = "select id from reservation where trajet_id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   if ($statement->rowCount() > 0) {
    return -1;
   }

   $query = "delete from trajet where id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   return null;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

}
?>
<!-- ----- fin ModelTrajet -->

