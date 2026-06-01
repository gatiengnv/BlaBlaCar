<!-- ----- debut ModelVille -->

<?php
require_once __DIR__ . '/Model.php';

class ModelVille {
 private $id, $nom;

 public function __construct($id = NULL, $nom = NULL) {
  if (!is_null($id)) {
   $this->id = $id;
   $this->nom = $nom;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setNom($nom) {
  $this->nom = $nom;
 }

 function getId() {
  return $this->id;
 }

 function getNom() {
  return $this->nom;
 }

 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from ville";
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
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelVille");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from ville";
   $statement = $database->prepare($query);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelVille");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from ville where id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelVille");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($nom) {
  try {
   $database = Model::getInstance();
   $query = "select max(id) from ville";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   $query = "insert into ville (id, nom) values (:id, :nom)";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'nom' => $nom
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($id, $nom) {
  try {
   $database = Model::getInstance();
   $query = "update ville set nom = :nom where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'nom' => $nom
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

   $query = "select id from trajet where ville_depart = :id or ville_arrivee = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   if ($statement->rowCount() > 0) {
    return -1;
   }

   $query = "delete from ville where id = :id";
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
<!-- ----- fin ModelVille -->

