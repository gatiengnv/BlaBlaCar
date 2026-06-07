<?php

require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/ModelTrajetEnrichi.php';

/**
 * Modèle représentant un trajet.
 */
class ModelTrajet
{
    /** Identifiant unique du trajet */
    private int $id;

    /** Identifiant de la ville de départ */
    private int $ville_depart;

    /** Identifiant de la ville d'arrivée */
    private int $ville_arrivee;

    /** Identifiant du conducteur */
    private int $conducteur_id;

    /** Identifiant du véhicule utilisé pour le trajet */
    private int $vehicule_id;

    /** Prix du trajet pour un passager */
    private float $prix;

    /** Date de départ du trajet */
    private string $date_depart;

    /** Heure de départ du trajet */
    private string $heure_depart;

    /** Statut du trajet : actif ou passif */
    private string $statut;

    /**
     * Constructeur de la classe ModelTrajet.
     *
     * @param int|null $id Identifiant du trajet.
     * @param int|null $ville_depart Identifiant de la ville de départ.
     * @param int|null $ville_arrivee Identifiant de la ville d'arrivée.
     * @param int|null $conducteur_id Identifiant du conducteur.
     * @param int|null $vehicule_id Identifiant du véhicule.
     * @param float|null $prix Prix du trajet.
     * @param string|null $date_depart Date de départ du trajet.
     * @param string|null $heure_depart Heure de départ du trajet.
     * @param string|null $statut Statut du trajet.
     */
    public function __construct(
        $id = NULL,
        $ville_depart = NULL,
        $ville_arrivee = NULL,
        $conducteur_id = NULL,
        $vehicule_id = NULL,
        $prix = NULL,
        $date_depart = NULL,
        $heure_depart = NULL,
        $statut = NULL
    ) {
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

    /**
     * Accesseur de l'identifiant du trajet.
     *
     * @return int Identifiant du trajet.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Accesseur de l'identifiant de la ville de départ.
     *
     * @return int Identifiant de la ville de départ.
     */
    function getVille_depart()
    {
        return $this->ville_depart;
    }

    /**
     * Accesseur de l'identifiant de la ville d'arrivée.
     *
     * @return int Identifiant de la ville d'arrivée.
     */
    function getVille_arrivee()
    {
        return $this->ville_arrivee;
    }

    /**
     * Accesseur de l'identifiant du conducteur.
     *
     * @return int Identifiant du conducteur.
     */
    function getConducteur_id()
    {
        return $this->conducteur_id;
    }

    /**
     * Accesseur de l'identifiant du véhicule.
     *
     * @return int Identifiant du véhicule.
     */
    function getVehicule_id()
    {
        return $this->vehicule_id;
    }

    /**
     * Accesseur du prix du trajet.
     *
     * @return float Prix du trajet.
     */
    function getPrix()
    {
        return $this->prix;
    }

    /**
     * Accesseur de la date de départ du trajet.
     *
     * @return string Date de départ du trajet.
     */
    function getDate_depart()
    {
        return $this->date_depart;
    }

    /**
     * Accesseur de l'heure de départ du trajet.
     *
     * @return string Heure de départ du trajet.
     */
    function getHeure_depart()
    {
        return $this->heure_depart;
    }

    /**
     * Accesseur du statut du trajet.
     *
     * @return string Statut du trajet.
     */
    function getStatut()
    {
        return $this->statut;
    }

    /**
     * Modifie l'identifiant du trajet.
     *
     * @param int $id Nouvel identifiant du trajet.
     * @return void Rien.
     */
    function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Modifie l'identifiant de la ville de départ.
     *
     * @param int $ville_depart Nouvel identifiant de la ville de départ.
     * @return void Rien.
     */
    function setVille_depart(int $ville_depart)
    {
        $this->ville_depart = $ville_depart;
    }

    /**
     * Modifie l'identifiant de la ville d'arrivée.
     *
     * @param int $ville_arrivee Nouvel identifiant de la ville d'arrivée.
     * @return void Rien.
     */
    function setVille_arrivee(int $ville_arrivee)
    {
        $this->ville_arrivee = $ville_arrivee;
    }

    /**
     * Modifie l'identifiant du conducteur.
     *
     * @param int $conducteur_id Nouvel identifiant du conducteur.
     * @return void Rien.
     */
    function setConducteur_id(int $conducteur_id)
    {
        $this->conducteur_id = $conducteur_id;
    }

    /**
     * Modifie l'identifiant du véhicule.
     *
     * @param int $vehicule_id Nouvel identifiant du véhicule.
     * @return void Rien.
     */
    function setVehicule_id(int $vehicule_id)
    {
        $this->vehicule_id = $vehicule_id;
    }

    /**
     * Modifie le prix du trajet.
     *
     * @param float $prix Nouveau prix du trajet.
     * @return void Rien.
     */
    function setPrix(float $prix)
    {
        $this->prix = $prix;
    }

    /**
     * Modifie la date de départ du trajet.
     *
     * @param string $date_depart Nouvelle date de départ du trajet.
     * @return void Rien.
     */
    function setDate_depart(string $date_depart)
    {
        $this->date_depart = $date_depart;
    }

    /**
     * Modifie l'heure de départ du trajet.
     *
     * @param string $heure_depart Nouvelle heure de départ du trajet.
     * @return void Rien.
     */
    function setHeure_depart(string $heure_depart)
    {
        $this->heure_depart = $heure_depart;
    }

    /**
     * Modifie le statut du trajet.
     *
     * @param string $statut Nouveau statut du trajet.
     * @return void Rien.
     */
    function setStatut(string $statut)
    {
        $this->statut = $statut;
    }

    /**
     * Retourne tous les identifiants des trajets.
     *
     * @return array|null Tableau des identifiants ou NULL en cas d'erreur.
     */
    public static function getAllId()
    {
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

    /**
     * Retourne plusieurs trajets selon une requête SQL.
     *
     * @param string $query Requête SQL à exécuter.
     * @return array|null Tableau d'objets ModelTrajet ou NULL en cas d'erreur.
     */
    public static function getMany(string $query)
    {
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

    /**
     * Retourne tous les trajets d'un conducteur avec les noms des villes.
     *
     * @param int $conducteur_id Identifiant du conducteur.
     * @return array|null Tableau d'objets ModelTrajetEnrichi ou NULL en cas d'erreur.
     */
    public static function getByConducteurId(int $conducteur_id)
    {
        try {
            $database = Model::getInstance();

            $query = "select t.id, vd.nom as nom_depart, va.nom as nom_arrivee, 
                             t.date_depart, t.heure_depart, t.prix, t.statut
                      from trajet t
                      join ville vd on t.ville_depart = vd.id
                      join ville va on t.ville_arrivee = va.id
                      where t.conducteur_id = :conducteur_id
                      order by t.date_depart desc";

            $statement = $database->prepare($query);
            $statement->execute(['conducteur_id' => $conducteur_id]);

            return $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajetEnrichi");
        } catch (PDOException $e) {

            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Retourne tous les trajets.
     *
     * @return array|null Tableau d'objets ModelTrajet ou NULL en cas d'erreur.
     */
    public static function getAll()
    {
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

    /**
     * Retourne un trajet à partir de son identifiant.
     *
     * @param int $id Identifiant du trajet.
     * @return array|null Trajet correspondant ou NULL en cas d'erreur.
     */
    public static function getOne(int $id)
    {
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

    /**
     * Retourne  pour un utilisateur donné
     * 
     */
    public static function getByPassagerId(int $passagerId)
    {
        try {
            $database = Model::getInstance();

            $query = "
            SELECT
                t.id,
                vd.nom AS nom_depart,
                va.nom AS nom_arrivee,
                t.date_depart,
                t.heure_depart,
                t.prix,
                t.statut
            FROM reservation r
            JOIN trajet t ON r.trajet_id = t.id
            JOIN ville vd ON t.ville_depart = vd.id
            JOIN ville va ON t.ville_arrivee = va.id
            WHERE r.passager_id = :passagerId
            ORDER BY t.date_depart DESC, t.heure_depart DESC
        ";

            $statement = $database->prepare($query);
            $statement->execute([
                'passagerId' => $passagerId
            ]);

            return $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajetEnrichi");
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Retourne tous les trajets actifs avec les noms des villes.
     *
     */
    public static function getAllActifs()
    {
        try {
            $database = Model::getInstance();

            $query = "select t.id, vd.nom as nom_depart, va.nom as nom_arrivee,
                         t.date_depart, t.heure_depart, t.prix, t.statut
                  from trajet t
                  join ville vd on t.ville_depart = vd.id
                  join ville va on t.ville_arrivee = va.id
                  where t.statut = 'actif'
                  order by t.date_depart asc, t.heure_depart asc";

            $statement = $database->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajetEnrichi");
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    /**
     * Insère un nouveau trajet dans la base de données.
     *
     * @param int $ville_depart Identifiant de la ville de départ.
     * @param int $ville_arrivee Identifiant de la ville d'arrivée.
     * @param int $conducteur_id Identifiant du conducteur.
     * @param int $vehicule_id Identifiant du véhicule utilisé.
     * @param float $prix Prix du trajet.
     * @param string $date_depart Date de départ du trajet.
     * @param string $heure_depart Heure de départ du trajet.
     * @param string $statut Statut du trajet.
     * @return int Identifiant du nouveau trajet ou -1 en cas d'erreur.
     */
    public static function insert($ville_depart, $ville_arrivee, $conducteur_id, $vehicule_id, $prix, $date_depart, $heure_depart, $statut)
    {
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

    /**
     * Met à jour un trajet dans la base de données.
     *
     * @param int $id Identifiant du trajet.
     * @param int $ville_depart Identifiant de la ville de départ.
     * @param int $ville_arrivee Identifiant de la ville d'arrivée.
     * @param int $conducteur_id Identifiant du conducteur.
     * @param int $vehicule_id Identifiant du véhicule utilisé.
     * @param float $prix Prix du trajet.
     * @param string $date_depart Date de départ du trajet.
     * @param string $heure_depart Heure de départ du trajet.
     * @param string $statut Statut du trajet.
     * @return int Nombre de lignes modifiées ou -1 en cas d'erreur.
     */
    public static function update($id, $ville_depart, $ville_arrivee, $conducteur_id, $vehicule_id, $prix, $date_depart, $heure_depart, $statut)
    {
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

    /**
     * Met à jour uniquement le statut d'un trajet.
     *
     * @param int $id Identifiant du trajet.
     * @param string $statut Nouveau statut du trajet ('actif' ou 'passif').
     * @return int Nombre de lignes modifiées ou -1 en cas d'erreur.
     */
    public static function updateStatut(int $id, string $statut): int
    {
        try {
            $database = Model::getInstance();
            $query = "update trajet set statut = :statut where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'statut' => $statut
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    /**
     * Supprime un trajet de la base de données.
     *
     * La suppression est refusée si le trajet possède déjà une réservation.
     *
     * @param int $id Identifiant du trajet.
     * @return int|null -1 en cas d'erreur ou de dépendance existante, NULL sinon.
     */
    public static function delete(int $id)
    {
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
