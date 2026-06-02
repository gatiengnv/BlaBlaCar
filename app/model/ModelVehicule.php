<?php

require_once __DIR__ . '/Model.php';

/**
 * Modèle représentant un véhicule.
 */
class ModelVehicule
{
    /** Identifiant unique du véhicule */
    private int $id;

    /** Marque du véhicule */
    private string $marque;

    /** Modèle du véhicule */
    private string $modele;

    /** Année du véhicule */
    private int $annee;

    /** Plaque d'immatriculation du véhicule */
    private string $immatriculation;

    /** Identifiant du propriétaire du véhicule */
    private int $proprietaire_id;

    /**
     * Constructeur de la classe ModelVehicule.
     *
     * @param int|null $id Identifiant du véhicule.
     * @param string|null $marque Marque du véhicule.
     * @param string|null $modele Modèle du véhicule.
     * @param int|null $annee Année du véhicule.
     * @param string|null $immatriculation Plaque d'immatriculation du véhicule.
     * @param int|null $proprietaire_id Identifiant du propriétaire du véhicule.
     */
    public function __construct(
        $id = NULL,
        $marque = NULL,
        $modele = NULL,
        $annee = NULL,
        $immatriculation = NULL,
        $proprietaire_id = NULL
    ) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->marque = $marque;
            $this->modele = $modele;
            $this->annee = $annee;
            $this->immatriculation = $immatriculation;
            $this->proprietaire_id = $proprietaire_id;
        }
    }

    /**
     * Accesseur de l'identifiant du véhicule.
     *
     * @return int Identifiant du véhicule.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Accesseur de la marque du véhicule.
     *
     * @return string Marque du véhicule.
     */
    function getMarque()
    {
        return $this->marque;
    }

    /**
     * Accesseur du modèle du véhicule.
     *
     * @return string Modèle du véhicule.
     */
    function getModele()
    {
        return $this->modele;
    }

    /**
     * Accesseur de l'année du véhicule.
     *
     * @return int Année du véhicule.
     */
    function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Accesseur de la plaque d'immatriculation du véhicule.
     *
     * @return string Plaque d'immatriculation du véhicule.
     */
    function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Accesseur de l'identifiant du propriétaire du véhicule.
     *
     * @return int Identifiant du propriétaire du véhicule.
     */
    function getProprietaire_id()
    {
        return $this->proprietaire_id;
    }

    /**
     * Modifie l'identifiant du véhicule.
     *
     * @param int $id Nouvel identifiant du véhicule.
     * @return void Rien.
     */
    function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Modifie la marque du véhicule.
     *
     * @param string $marque Nouvelle marque du véhicule.
     * @return void Rien.
     */
    function setMarque(string $marque)
    {
        $this->marque = $marque;
    }

    /**
     * Modifie le modèle du véhicule.
     *
     * @param string $modele Nouveau modèle du véhicule.
     * @return void Rien.
     */
    function setModele(string $modele)
    {
        $this->modele = $modele;
    }

    /**
     * Modifie l'année du véhicule.
     *
     * @param int $annee Nouvelle année du véhicule.
     * @return void Rien.
     */
    function setAnnee(int $annee)
    {
        $this->annee = $annee;
    }

    /**
     * Modifie la plaque d'immatriculation du véhicule.
     *
     * @param string $immatriculation Nouvelle plaque d'immatriculation du véhicule.
     * @return void Rien.
     */
    function setImmatriculation(string $immatriculation)
    {
        $this->immatriculation = $immatriculation;
    }

    /**
     * Modifie l'identifiant du propriétaire du véhicule.
     *
     * @param int $proprietaire_id Nouvel identifiant du propriétaire du véhicule.
     * @return void Rien.
     */
    function setProprietaire_id(int $proprietaire_id)
    {
        $this->proprietaire_id = $proprietaire_id;
    }

    /**
     * Retourne tous les identifiants des véhicules.
     *
     * @return array|null Tableau des identifiants ou NULL en cas d'erreur.
     */
    public static function getAllId()
    {
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

    /**
     * Retourne plusieurs véhicules selon une requête SQL.
     *
     * @param string $query Requête SQL à exécuter.
     * @return array|null Tableau d'objets ModelVehicule ou NULL en cas d'erreur.
     */
    public static function getMany(string $query)
    {
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

    /**
     * Retourne tous les véhicules.
     *
     * @return array|null Tableau d'objets ModelVehicule ou NULL en cas d'erreur.
     */
    public static function getAll()
    {
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

    /**
     * Retourne un véhicule à partir de son identifiant.
     *
     * @param int $id Identifiant du véhicule.
     * @return array|null Véhicule correspondant ou NULL en cas d'erreur.
     */
    public static function getOne(int $id)
    {
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

    /**
     * Insère un nouveau véhicule dans la base de données.
     *
     * @param string $marque Marque du véhicule.
     * @param string $modele Modèle du véhicule.
     * @param int $annee Année du véhicule.
     * @param string $immatriculation Plaque d'immatriculation du véhicule.
     * @param int $proprietaire_id Identifiant du propriétaire du véhicule.
     * @return int Identifiant du nouveau véhicule ou -1 en cas d'erreur.
     */
    public static function insert($marque, $modele, $annee, $immatriculation, $proprietaire_id)
    {
        try {
            $database = Model::getInstance();

            $query = "select max(id) from vehicule";
            $statement = $database->query($query);
            $tuple = $statement->fetch();

            $id = $tuple['0'];
            $id++;

            $query = "insert into vehicule 
                      (id, marque, modele, annee, immatriculation, proprietaire_id) 
                      values 
                      (:id, :marque, :modele, :annee, :immatriculation, :proprietaire_id)";

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

    /**
     * Met à jour un véhicule dans la base de données.
     *
     * @param int $id Identifiant du véhicule.
     * @param string $marque Marque du véhicule.
     * @param string $modele Modèle du véhicule.
     * @param int $annee Année du véhicule.
     * @param string $immatriculation Plaque d'immatriculation du véhicule.
     * @param int $proprietaire_id Identifiant du propriétaire du véhicule.
     * @return int Nombre de lignes modifiées ou -1 en cas d'erreur.
     */
    public static function update($id, $marque, $modele, $annee, $immatriculation, $proprietaire_id)
    {
        try {
            $database = Model::getInstance();

            $query = "update vehicule 
                      set marque = :marque, 
                          modele = :modele, 
                          annee = :annee, 
                          immatriculation = :immatriculation, 
                          proprietaire_id = :proprietaire_id 
                      where id = :id";

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

    /**
     * Supprime un véhicule de la base de données.
     *
     * La suppression est refusée si le véhicule est déjà utilisé dans un trajet.
     *
     * @param int $id Identifiant du véhicule.
     * @return int|null -1 en cas d'erreur ou de dépendance existante, NULL sinon.
     */
    public static function delete($id)
    {
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

            return NULL;
        } catch (PDOException $e) {

            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
