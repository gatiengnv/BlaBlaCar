<!-- ----- debut ModelVehicule -->

<?php
require_once __DIR__ . '/Model.php';

class ModelVehicule {
 private $id, $marque, $modele, $annee, $immatriculation, $proprietaire_id;

 public function __construct($id = NULL, $marque = NULL, $modele = NULL, $annee = NULL, $immatriculation = NULL, $proprietaire_id = NULL) {
  if (!is_null($id)) {
   $this->id = $id;
   $this->marque = $marque;
   $this->modele = $modele;
   $this->annee = $annee;
   $this->immatriculation = $immatriculation;
   $this->proprietaire_id = $proprietaire_id;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setMarque($marque) {
  $this->marque = $marque;
 }

 function setModele($modele) {
  $this->modele = $modele;
 }

 function setAnnee($annee) {
  $this->annee = $annee;
 }

 function setImmatriculation($immatriculation) {
  $this->immatriculation = $immatriculation;
 }

 function setProprietaire_id($proprietaire_id) {
  $this->proprietaire_id = $proprietaire_id;
 }

 function getId() {
  return $this->id;
 }

 function getMarque() {
  return $this->marque;
 }

 function getModele() {
  return $this->modele;
 }

 function getAnnee() {
  return $this->annee;
 }

 function getImmatriculation() {
  return $this->immatriculation;
 }

 function getProprietaire_id() {
  return $this->proprietaire_id;
 }

 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from vehicule";
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
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from vehicule";
   $statement = $database->prepare($query);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from vehicule where id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($marque, $modele, $annee, $immatriculation, $proprietaire_id) {
  try {
   $database = Model::getInstance();
   $query = "select max(id) from vehicule";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   $query = "insert into vehicule (id, marque, modele, annee, immatriculation, proprietaire_id) values (:id, :marque, :modele, :annee, :immatriculation, :proprietaire_id)";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'marque' => $marque,
    'modele' => $modele,
    'annee' => $annee,
    'immatriculation' => $immatriculation,
    'proprietaire_id' => $proprietaire_id
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($id, $marque, $modele, $annee, $immatriculation, $proprietaire_id) {
  try {
   $database = Model::getInstance();
   $query = "update vehicule set marque = :marque, modele = :modele, annee = :annee, immatriculation = :immatriculation, proprietaire_id = :proprietaire_id where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'marque' => $marque,
    'modele' => $modele,
    'annee' => $annee,
    'immatriculation' => $immatriculation,
    'proprietaire_id' => $proprietaire_id
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

   $query = "select id from trajet where vehicule_id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   if ($statement->rowCount() > 0) {
    return -1;
   }

   $query = "delete from vehicule where id = :id";
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
<!-- ----- fin ModelVehicule -->

