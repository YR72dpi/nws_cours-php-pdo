[< Retour](../../README.md)
```php 
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
```