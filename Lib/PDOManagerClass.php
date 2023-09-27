<?php

class PDOManagerClass {

    // To Edit
    private $host = 'localhost';
    private $db_name;
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct(string $DBName) {
        $this->db_name = $DBName;
        $this->connect();
    }

    // private
    private function connect() : bool {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return true;
        } catch (PDOException $e) {
            return false;
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // public
    public function findAll(string $table) : array {
        $data = [];
        $query = "SELECT * FROM $table";
        $prepare = $this->pdo->prepare($query);
        // les bind param
        $prepare->execute();
        while ($line = $prepare->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $line;
        }
        return $data;
    }


    public function findBy(string $table, array $criteria, array $order = null) : array {
        $data = [];
        $query = "SELECT * FROM $table";

        if (count($criteria) > 0) {
            $query .= " WHERE ";
            
            $n = 0;
            foreach ($criteria as $index => $value) {
                $query .= $index . " = '" . $value ."'";

                if($n < count($criteria)-1) {
                    $query .= " AND ";
                }
                $n++;
            }
        } 
        var_dump($query);

        if(!is_null($order)) {
            $arrayIndex = array_keys($order);
            $query .= "  ORDER BY " . $arrayIndex[0] . " " . $order[$arrayIndex[0]]; 
        }

        $prepare = $this->pdo->prepare($query);
        // les bind param
        $prepare->execute();
        while ($line = $prepare->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $line;
        }
        return $data;
    }
}