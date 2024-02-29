<?php
class Database {
    private $host = "mysql"; // Remplacez par l'hôte de votre base de données
    private $port = "3306";
    private $dbname = "afci"; // Remplacez par le nom de votre base de données
    private $user = "admin"; // Remplacez par votre nom d'utilisateur
    private $pass = "admin"; // Remplacez par votre mot de passe
    private $conn;
    private $stmt;

    // Connexion à la base de données
    public function connect() {
        $this->conn = null;
        try {
            // Correction des noms de variables pour la connexion
            $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'Erreur de connexion: ' . $e->getMessage();
        }
        return $this->conn;
    }

    // Préparation d'une requête SQL
    public function query($sql) {
        $this->stmt = $this->connect()->prepare($sql);
    }

    // Liaison des valeurs aux paramètres de la requête préparée
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Exécution de la requête préparée
    public function execute() {
        return $this->stmt->execute();
    }

    // Récupération des résultats de la requête sous forme de tableau
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Récupération d'un seul enregistrement de la requête
    public function single() {
        $this->execute();
        return $this->stmt->fetch();
    }
}
