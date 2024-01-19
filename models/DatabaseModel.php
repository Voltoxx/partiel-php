<?php

class Database {
    private $config;
    public $conn;

    public function __construct() {
        // Chargez la configuration depuis le fichier JSON
        $configJson = file_get_contents(__DIR__ . '/../config.json');
        $this->config = json_decode($configJson, true);

        // Instanciez la connexion à la base de données
        try {
            $this->conn = new PDO(
                "mysql:host={$this->config['host']};dbname={$this->config['database']}",
                $this->config['username'],
                $this->config['password']
            );

        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
