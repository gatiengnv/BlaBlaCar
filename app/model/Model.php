<?php

/**
 * Classe Model.
 *
 * Cette classe permet de gérer la connexion à la base de données
 * via le pattern Singleton.
 */
class Model extends PDO
{
    /** Instance unique de connexion PDO */
    private static $_instance;

    /**
     * Constructeur de la classe Model.
     *
     * Héritage public obligatoire de PDO.
     */
    public function __construct() {}

    /**
     * Retourne l'instance unique de connexion à la base de données.
     *
     * Les paramètres de connexion sont définis dans le fichier config.php.
     *
     * @return PDO|null Instance PDO de connexion ou NULL en cas d'erreur.
     */
    public static function getInstance()
    {
        // les variables sont définies dans le fichier config.php
        include_once '../controller/config.php';

        if (DEBUG) echo ("Model : getInstance : dsn = $dsn</br>");

        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        if (!isset(self::$_instance)) {
            try {
                self::$_instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            }
        }
        return self::$_instance;
    }
}
