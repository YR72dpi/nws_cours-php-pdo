`[< Retour](../../README.md)
```php
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
````