<?php

require_once __DIR__ . '/Model.php';

/**
 * Modèle représentant une réservation.
 */
class ModelReservation
{
    /** Identifiant unique de la réservation */
    private int $id;

    /** Identifiant du trajet réservé */
    private int $trajet_id;

    /** Identifiant du passager ayant effectué la réservation */
    private int $passager_id;

    /**
     * Constructeur de la classe ModelReservation.
     *
     * @param int|null $id Identifiant de la réservation.
     * @param int|null $trajet_id Identifiant du trajet réservé.
     * @param int|null $passager_id Identifiant du passager.
     */
    public function __construct($id = NULL, $trajet_id = NULL, $passager_id = NULL)
    {
        if (!is_null($id)) {
            $this->id = $id;
            $this->trajet_id = $trajet_id;
            $this->passager_id = $passager_id;
        }
    }

    /**
     * Accesseur de l'identifiant de la réservation.
     *
     * @return int Identifiant de la réservation.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Accesseur de l'identifiant du trajet réservé.
     *
     * @return int Identifiant du trajet réservé.
     */
    function getTrajet_id()
    {
        return $this->trajet_id;
    }

    /**
     * Accesseur de l'identifiant du passager.
     *
     * @return int Identifiant du passager.
     */
    function getPassager_id()
    {
        return $this->passager_id;
    }

    /**
     * Modifie l'identifiant de la réservation.
     *
     * @param int $id Nouvel identifiant de la réservation.
     * @return void Rien.
     */
    function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Modifie l'identifiant du trajet réservé.
     *
     * @param int $trajet_id Nouvel identifiant du trajet réservé.
     * @return void Rien.
     */
    function setTrajet_id(int $trajet_id)
    {
        $this->trajet_id = $trajet_id;
    }

    /**
     * Modifie l'identifiant du passager.
     *
     * @param int $passager_id Nouvel identifiant du passager.
     * @return void Rien.
     */
    function setPassager_id(int $passager_id)
    {
        $this->passager_id = $passager_id;
    }

    /**
     * Retourne tous les identifiants des réservations.
     *
     * @return array|null Tableau des identifiants ou NULL en cas d'erreur.
     */
    public static function getAllId()
    {
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

    /**
     * Retourne plusieurs réservations selon une requête SQL.
     *
     * @param string $query Requête SQL à exécuter.
     * @return array|null Tableau d'objets ModelReservation ou NULL en cas d'erreur.
     */
    public static function getMany(string $query)
    {
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

    /**
     * Retourne toutes les réservations.
     *
     * @return array|null Tableau d'objets ModelReservation ou NULL en cas d'erreur.
     */
    public static function getAll()
    {
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

    /**
     * Retourne une réservation à partir de son identifiant.
     *
     * @param int $id Identifiant de la réservation.
     * @return array|null Réservation correspondante ou NULL en cas d'erreur.
     */
    public static function getOne(int $id)
    {
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

    /**
     * Insère une nouvelle réservation dans la base de données.
     *
     * @param int $trajet_id Identifiant du trajet réservé.
     * @param int $passager_id Identifiant du passager.
     * @return int Identifiant de la nouvelle réservation ou -1 en cas d'erreur.
     */
    public static function insert(int $trajet_id, int $passager_id)
    {
        try {
            $database = Model::getInstance();

            $query = "select max(id) from reservation";
            $statement = $database->query($query);

            $tuple = $statement->fetch();

            $id = $tuple['0'];
            $id++;

            $query = "insert into reservation 
                      (id, trajet_id, passager_id) 
                      values 
                      (:id, :trajet_id, :passager_id)";

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

    /**
     * Met à jour une réservation dans la base de données.
     *
     * @param int $id Identifiant de la réservation.
     * @param int $trajet_id Identifiant du trajet réservé.
     * @param int $passager_id Identifiant du passager.
     * @return int Nombre de lignes modifiées ou -1 en cas d'erreur.
     */
    public static function update(int $id, int $trajet_id, int $passager_id)
    {
        try {
            $database = Model::getInstance();

            $query = "update reservation 
                      set trajet_id = :trajet_id, 
                          passager_id = :passager_id 
                      where id = :id";

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

    /**
     * Retourne les passagers ayant réservé un trajet donné.
     *
     * @param int $trajet_id Identifiant du trajet.
     * @return array|null Tableau d'objets ModelUtilisateur ou NULL en cas d'erreur.
     */
    public static function getPassagersByTrajetId(int $trajet_id)
    {
        try {
            $database = Model::getInstance();

            $query = "SELECT u.id, u.nom, u.prenom, u.role, u.login, u.password, u.solde
                      FROM reservation r
                      JOIN utilisateur u ON r.passager_id = u.id
                      WHERE r.trajet_id = :trajet_id";

            $statement = $database->prepare($query);
            $statement->execute(['trajet_id' => $trajet_id]);

            return $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");

        } catch (PDOException $e) {

            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Supprime une réservation de la base de données.
     *
     * @param int $id Identifiant de la réservation.
     * @return int|null -1 en cas d'erreur, NULL sinon.
     */
    public static function delete(int $id)
    {
        try {
            $database = Model::getInstance();

            $query = "delete from reservation where id = :id";

            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);

            return NULL;

        } catch (PDOException $e) {

            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}

?>