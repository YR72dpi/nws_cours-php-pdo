[< Retour](../../README.md)
```php
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
```