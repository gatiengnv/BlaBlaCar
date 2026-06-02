<?php

require_once __DIR__ . '/Model.php';

/**
 * Modèle représentant une ville.
 */
class ModelVille
{
    /** Identifiant unique de la ville */
    private int $id;

    /** Nom de la ville */
    private string $nom;

    /**
     * Constructeur de la classe ModelVille.
     *
     * @param int|null $id Identifiant de la ville.
     * @param string|null $nom Nom de la ville.
     */
    public function __construct($id = NULL, $nom = NULL)
    {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
        }
    }

    /**
     * Accesseur de l'identifiant de la ville.
     *
     * @return int Identifiant de la ville.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Accesseur du nom de la ville.
     *
     * @return string Nom de la ville.
     */
    function getNom()
    {
        return $this->nom;
    }

    /**
     * Modifie l'identifiant de la ville.
     *
     * @param int $id Nouvel identifiant de la ville.
     * @return void Rien.
     */
    function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Modifie le nom de la ville.
     *
     * @param string $nom Nouveau nom de la ville.
     * @return void Rien.
     */
    function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * Retourne tous les identifiants des villes.
     *
     * @return array|null Tableau des identifiants ou NULL en cas d'erreur.
     */
    public static function getAllId()
    {
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

    /**
     * Retourne plusieurs villes selon une requête SQL.
     *
     * @param string $query Requête SQL à exécuter.
     * @return array|null Tableau d'objets ModelVille ou NULL en cas d'erreur.
     */
    public static function getMany(string $query)
    {
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

    /**
     * Retourne toutes les villes.
     *
     * @return array|null Tableau d'objets ModelVille ou NULL en cas d'erreur.
     */
    public static function getAll()
    {
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

    /**
     * Retourne une ville à partir de son identifiant.
     *
     * @param int $id Identifiant de la ville.
     * @return array|null Ville correspondante ou NULL en cas d'erreur.
     */
    public static function getOne(int $id)
    {
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

    /**
     * Insère une nouvelle ville dans la base de données.
     *
     * @param string $nom Nom de la ville.
     * @return int Identifiant de la nouvelle ville ou -1 en cas d'erreur.
     */
    public static function insert($nom)
    {
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

    /**
     * Met à jour une ville dans la base de données.
     *
     * @param int $id Identifiant de la ville.
     * @param string $nom Nouveau nom de la ville.
     * @return int Nombre de lignes modifiées ou -1 en cas d'erreur.
     */
    public static function update($id, $nom)
    {
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

    /**
     * Supprime une ville de la base de données.
     *
     * La suppression est refusée si la ville est utilisée
     * dans un trajet comme ville de départ ou d'arrivée.
     *
     * @param int $id Identifiant de la ville.
     * @return int|null -1 en cas d'erreur ou de dépendance existante, NULL sinon.
     */
    public static function delete($id)
    {
        try {
            $database = Model::getInstance();

            $query = "select id from trajet 
                      where ville_depart = :id 
                      or ville_arrivee = :id";

            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);

            if ($statement->rowCount() > 0) {
                return -1;
            }

            $query = "delete from ville where id = :id";

            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);

            return NULL;
        } catch (PDOException $e) {

            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
