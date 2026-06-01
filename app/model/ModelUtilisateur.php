<!-- ----- debut ModelUtilisateur -->

<?php
require_once __DIR__ . '/Model.php';

class ModelUtilisateur {
 private $id, $nom, $prenom, $role, $login, $password, $solde;

 public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $role = NULL, $login = NULL, $password = NULL, $solde = NULL) {
  if (!is_null($id)) {
   $this->id = $id;
   $this->nom = $nom;
   $this->prenom = $prenom;
   $this->role = $role;
   $this->login = $login;
   $this->password = $password;
   $this->solde = $solde;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setNom($nom) {
  $this->nom = $nom;
 }

 function setPrenom($prenom) {
  $this->prenom = $prenom;
 }

 function setRole($role) {
  $this->role = $role;
 }

 function setLogin($login) {
  $this->login = $login;
 }

 function setPassword($password) {
  $this->password = $password;
 }

 function setSolde($solde) {
  $this->solde = $solde;
 }

 function getId() {
  return $this->id;
 }

 function getNom() {
  return $this->nom;
 }

 function getPrenom() {
  return $this->prenom;
 }

 function getRole() {
  return $this->role;
 }

 function getLogin() {
  return $this->login;
 }

 function getPassword() {
  return $this->password;
 }

 function getSolde() {
  return $this->solde;
 }

 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from utilisateur";
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
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from utilisateur";
   $statement = $database->prepare($query);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from utilisateur where id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   return $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($nom, $prenom, $role, $login, $password, $solde) {
  try {
   $database = Model::getInstance();
   $query = "select max(id) from utilisateur";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   $query = "insert into utilisateur (id, nom, prenom, role, login, password, solde) values (:id, :nom, :prenom, :role, :login, :password, :solde)";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'nom' => $nom,
    'prenom' => $prenom,
    'role' => $role,
    'login' => $login,
    'password' => $password,
    'solde' => $solde
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($id, $nom, $prenom, $role, $login, $password, $solde) {
  try {
   $database = Model::getInstance();
   $query = "update utilisateur set nom = :nom, prenom = :prenom, role = :role, login = :login, password = :password, solde = :solde where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
    'id' => $id,
    'nom' => $nom,
    'prenom' => $prenom,
    'role' => $role,
    'login' => $login,
    'password' => $password,
    'solde' => $solde
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

   $query = "select id from trajet where conducteur_id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   if ($statement->rowCount() > 0) {
    return -1;
   }

   $query = "select id from vehicule where proprietaire_id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   if ($statement->rowCount() > 0) {
    return -1;
   }

   $query = "select id from reservation where passager_id = :id";
   $statement = $database->prepare($query);
   $statement->execute(['id' => $id]);
   if ($statement->rowCount() > 0) {
    return -1;
   }

   $query = "delete from utilisateur where id = :id";
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
<!-- ----- fin ModelUtilisateur -->

