<?php

class PDOManagerClass
{

    // To Edit
    private $host = 'localhost';
    private $db_name;
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct(string $DBName)
    {
        $this->db_name = $DBName;
        $this->connect();
    }

    // private
    private function connect(): bool
    {
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
    public function findAll(string $table): array
    {
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


    public function findBy(string $table, array $criteria, array $order = null): array
    {
        $data = [];
        $query = "SELECT * FROM $table";

        if (count($criteria) > 0) {
            $query .= " WHERE ";

            $n = 0;
            foreach ($criteria as $index => $value) {
                $query .= $index . " = '" . $value . "'";

                if ($n < count($criteria) - 1) {
                    $query .= " AND ";
                }
                $n++;
            }
        }

        if (!is_null($order)) {
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

    public function post(string $table, array $columnData): bool
    {
        $query = "INSERT INTO " . $table . " ";

        $column = array_keys($columnData);
        $values = array_values($columnData);

        $query_column   = "(";
        $query_value    = "VALUES (";
        foreach ($column as $name) {
            $query_value .= ":";
            if ($name === array_key_last($columnData)) {
                $query_value .= $name;
                $query_column .= $name;
            } else {
                $query_value .= $name . ", ";
                $query_column .= $name . ", ";
            }
        }
        $query_column   .= ")";
        $query_value    .= ")";

        $query .= $query_column . " " . $query_value;

        $prepare = $this->pdo->prepare($query);

        foreach ($columnData as $column => &$value) {
            var_dump(":" . $column. " " . $value);
            $prepare->bindParam(":" . $column, $value);
        }

        try {
            $prepare->execute();
            return true;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

        return false;
    }

    /* 
        /!\ Return true si bien supprimé ou déjà supprimé
    */
    public function delete(string $table, int $id): bool {
        $query = "DELETE FROM $table WHERE id = :id";
        $prepare = $this->pdo->prepare($query);
        $prepare->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $prepare->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return false;
    }

    public function update(string $table, int $id, array $columnData): bool {
        $query = "UPDATE $table SET ";

        foreach ($columnData as $column => $value) {
            if ($column === array_key_last($columnData)) {
                $query .= "$column = '$value' ";
            } else {
                $query .= "$column = '$value', ";
            }
        }

        $query .= "WHERE id = :id";

        $prepare = $this->pdo->prepare($query);
        $prepare->bindParam(':id', $id, PDO::PARAM_INT);

        var_dump($query);
        try {
            $prepare->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return false;
    }
}
