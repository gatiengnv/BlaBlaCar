<!-- ----- debut ModelReservation -->

<?php
require_once __DIR__ . '/Model.php';

class ModelReservation {
 private $id, $trajet_id, $passager_id;

 public function __construct($id = NULL, $trajet_id = NULL, $passager_id = NULL) {
  if (!is_null($id)) {
   $this->id = $id;
   $this->trajet_id = $trajet_id;
   $this->passager_id = $passager_id;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setTrajet_id($trajet_id) {
  $this->trajet_id = $trajet_id;
 }

 function setPassager_id($passager_id) {
  $this->passager_id = $passager_id;
 }

 function getId() {
  return $this->id;
 }

 function getTrajet_id() {
  return $this->trajet_id;
 }

 function getPassager_id() {
  return $this->passager_id;
 }

 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from reservation";
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
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from reservation";
   $statement = $database->prepare($query);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from reservation where id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($trajet_id, $passager_id) {
  try {
   $database = Model::getInstance();
   $query = "select max(id) from reservation";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   $query = "insert into reservation (id, trajet_id, passager_id) values (:id, :trajet_id, :passager_id)";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'trajet_id' => $trajet_id,
    'passager_id' => $passager_id
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($id, $trajet_id, $passager_id) {
  try {
   $database = Model::getInstance();
   $query = "update reservation set trajet_id = :trajet_id, passager_id = :passager_id where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'trajet_id' => $trajet_id,
    'passager_id' => $passager_id
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
   $query = "delete from reservation where id = :id";
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
<!-- ----- fin ModelReservation -->

