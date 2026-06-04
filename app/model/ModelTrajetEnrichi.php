<?php

/**
 * Modèle représentant un trajet enrichi avec les données des villes.
 * Utilisé pour l'affichage dans les vues avec jointures SQL.
 */
class ModelTrajetEnrichi
{
    /** Identifiant unique du trajet */
    private int $id;

    /** Nom de la ville de départ */
    private string $nom_depart;

    /** Nom de la ville d'arrivée */
    private string $nom_arrivee;

    /** Date de départ du trajet */
    private string $date_depart;

    /** Heure de départ du trajet */
    private string $heure_depart;

    /** Prix du trajet pour un passager */
    private float $prix;

    /** Statut du trajet : actif ou passif */
    private string $statut;

    /**
     * Constructeur de la classe ModelTrajetEnrichi.
     *
     * @param int|null $id Identifiant du trajet.
     * @param string|null $nom_depart Nom de la ville de départ.
     * @param string|null $nom_arrivee Nom de la ville d'arrivée.
     * @param string|null $date_depart Date de départ du trajet.
     * @param string|null $heure_depart Heure de départ du trajet.
     * @param float|null $prix Prix du trajet.
     * @param string|null $statut Statut du trajet.
     */
    public function __construct(
        $id = NULL,
        $nom_depart = NULL,
        $nom_arrivee = NULL,
        $date_depart = NULL,
        $heure_depart = NULL,
        $prix = NULL,
        $statut = NULL
    ) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom_depart = $nom_depart;
            $this->nom_arrivee = $nom_arrivee;
            $this->date_depart = $date_depart;
            $this->heure_depart = $heure_depart;
            $this->prix = $prix;
            $this->statut = $statut;
        }
    }

    /**
     * Accesseur de l'identifiant du trajet.
     *
     * @return int Identifiant du trajet.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur du nom de la ville de départ.
     *
     * @return string Nom de la ville de départ.
     */
    public function getNom_depart(): string
    {
        return $this->nom_depart;
    }

    /**
     * Accesseur du nom de la ville d'arrivée.
     *
     * @return string Nom de la ville d'arrivée.
     */
    public function getNom_arrivee(): string
    {
        return $this->nom_arrivee;
    }

    /**
     * Accesseur de la date de départ du trajet.
     *
     * @return string Date de départ du trajet.
     */
    public function getDate_depart(): string
    {
        return $this->date_depart;
    }

    /**
     * Accesseur de l'heure de départ du trajet.
     *
     * @return string Heure de départ du trajet.
     */
    public function getHeure_depart(): string
    {
        return $this->heure_depart;
    }

    /**
     * Accesseur du prix du trajet.
     *
     * @return float Prix du trajet.
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * Accesseur du statut du trajet.
     *
     * @return string Statut du trajet.
     */
    public function getStatut(): string
    {
        return $this->statut;
    }
}
?>

