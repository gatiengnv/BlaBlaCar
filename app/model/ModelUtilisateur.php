<?php

require_once __DIR__ . '/Model.php';

/**
 * Modèle représentant un utilisateur
 */
class ModelUtilisateur
{

    /** Identifiant unique de l'utilisateur */
    private int $id;

    /** Nom de famille de l'utilisateur */
    private string $nom;

    /** Prénom de l'utilisateur */
    private string $prenom;

    /** Rôle de l'utilisateur (administrateur, conducteur, passager) */
    private string $role;

    /** Login de l'utilisateur */
    private string $login;

    /** Mot de passe de l'utilisateur */
    private string $password;

    /** Solde de l'utilisateur en euros */
    private float $solde;

    /**
     * Constructeur de la classe ModelUtilisateur.
     *
     * @param int|null $id Identifiant de l'utilisateur.
     * @param string|null $nom Nom de l'utilisateur.
     * @param string|null $prenom Prénom de l'utilisateur.
     * @param string|null $role Rôle de l'utilisateur.
     * @param string|null $login Login de l'utilisateur.
     * @param string|null $password Mot de passe de l'utilisateur.
     * @param float|null $solde Solde de l'utilisateur.
     */
    public function __construct(
        $id = NULL,
        $nom = NULL,
        $prenom = NULL,
        $role = NULL,
        $login = NULL,
        $password = NULL,
        $solde = NULL
    ) {
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

    /**
     * Accesseur de l'identifiant de l'utilisateur.
     *
     * @return int Identifiant de l'utilisateur.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Accesseur du nom de l'utilisateur.
     *
     * @return string Nom de l'utilisateur.
     */
    function getNom()
    {
        return $this->nom;
    }

    /**
     * Accesseur du prénom de l'utilisateur.
     *
     * @return string Prénom de l'utilisateur.
     */
    function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Accesseur du rôle de l'utilisateur.
     *
     * @return string Rôle de l'utilisateur.
     */
    function getRole()
    {
        return $this->role;
    }

    /**
     * Accesseur du login de l'utilisateur.
     *
     * @return string Login de l'utilisateur.
     */
    function getLogin()
    {
        return $this->login;
    }

    /**
     * Accesseur du mot de passe de l'utilisateur.
     *
     * @return string Mot de passe de l'utilisateur.
     */
    function getPassword()
    {
        return $this->password;
    }

    /**
     * Accesseur du solde de l'utilisateur.
     *
     * @return float Solde de l'utilisateur.
     */
    function getSolde()
    {
        return $this->solde;
    }

    /**
     * Modifie l'identifiant de l'utilisateur.
     *
     * @param int $id Nouvel identifiant de l'utilisateur.
     * @return void Rien.
     */
    function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Modifie le nom de l'utilisateur.
     *
     * @param string $nom Nouveau nom de l'utilisateur.
     * @return void Rien.
     */
    function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * Modifie le prénom de l'utilisateur.
     *
     * @param string $prenom Nouveau prénom de l'utilisateur.
     * @return void Rien.
     */
    function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Modifie le rôle de l'utilisateur.
     *
     * @param string $role Nouveau rôle de l'utilisateur.
     * @return void Rien.
     */
    function setRole(string $role)
    {
        $this->role = $role;
    }

    /**
     * Modifie le login de l'utilisateur.
     *
     * @param string $login Nouveau login de l'utilisateur.
     * @return void Rien.
     */
    function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * Modifie le mot de passe de l'utilisateur.
     *
     * @param string $password Nouveau mot de passe de l'utilisateur.
     * @return void Rien.
     */
    function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Modifie le solde de l'utilisateur.
     *
     * @param float $solde Nouveau solde de l'utilisateur.
     * @return void Rien.
     */
    function setSolde(float $solde)
    {
        $this->solde = $solde;
    }

    /**
     * Retourne tous les identifiants des utilisateurs.
     *
     * @return array|null Tableau des identifiants ou NULL en cas d'erreur.
     */
    public static function getAllId()
    {
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

    /**
     * Retourne plusieurs utilisateurs selon une requête SQL.
     *
     * @param string $query Requête SQL à exécuter.
     * @return array|null Tableau d'objets ModelUtilisateur ou NULL en cas d'erreur.
     */
    public static function getMany(string $query)
    {
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

    /**
     * Retourne tous les utilisateurs.
     *
     * @return array|null Tableau d'objets ModelUtilisateur ou NULL en cas d'erreur.
     */
    public static function getAll()
    {
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

    /**
     * Retourne un utilisateur à partir de son identifiant.
     *
     * @param int $id Identifiant de l'utilisateur.
     * @return array|null Utilisateur correspondant ou NULL en cas d'erreur.
     */
    public static function getOne(int $id)
    {
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


    /**
     * Insère un nouvel utilisateur dans la base de données.
     *
     * @param string $nom Nom de l'utilisateur.
     * @param string $prenom Prénom de l'utilisateur.
     * @param string $role Rôle de l'utilisateur.
     * @param string $login Login de l'utilisateur.
     * @param string $password Mot de passe de l'utilisateur.
     * @param float $solde Solde de l'utilisateur.
     * @return int Identifiant du nouvel utilisateur ou -1 en cas d'erreur.
     */
    public static function insert($nom, $prenom, $role, $login, $password, $solde)
    {
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

    /**
     * Met à jour un utilisateur dans la base de données.
     *
     * @param int $id Identifiant de l'utilisateur.
     * @param string $nom Nom de l'utilisateur.
     * @param string $prenom Prénom de l'utilisateur.
     * @param string $role Rôle de l'utilisateur.
     * @param string $login Login de l'utilisateur.
     * @param string $password Mot de passe de l'utilisateur.
     * @param float $solde Solde de l'utilisateur.
     * @return int Nombre de lignes modifiées ou -1 en cas d'erreur.
     */
    public static function update($id, $nom, $prenom, $role, $login, $password, $solde)
    {
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

    /**
     * Met à jour uniquement le solde d'un utilisateur.
     *
     * @param int $id Identifiant de l'utilisateur.
     * @param float $solde Nouveau solde de l'utilisateur.
     * @return int Nombre de lignes modifiées ou -1 en cas d'erreur.
     */
    public static function updateSolde(int $id, float $solde): int
    {
        try {
            $database = Model::getInstance();
            $query = "update utilisateur set solde = :solde where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'solde' => $solde
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    /**
     * Supprime un utilisateur de la base de données.
     *
     * @param int $id Identifiant de l'utilisateur.
     * @return int|null -1 en cas d'erreur ou de dépendances existantes, NULL sinon.
     */
    public static function delete($id)
    {
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
