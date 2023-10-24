```php
public function getRelation(
    array $relation, 
    string $select = null, 
    array $criteria, 
    array $order = null
    ): array {
        $primaryTable = $relation[0];
        $secondaryTable = $relation[1];

        $query = "SELECT * FROM $primaryTable[0]";
        if(!is_null($select)){
            $query = "SELECT $select FROM $primaryTable[0]";
        }

        $query .= " INNER JOIN $secondaryTable[0] ON $primaryTable[0].$primaryTable[1] = $secondaryTable[0].$secondaryTable[1]";

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
        $prepare->execute();
        while ($line = $prepare->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $line;
        }
        return $data;
    }
```