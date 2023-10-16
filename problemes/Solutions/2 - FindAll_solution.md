[< Retour](../../README.md)
```php
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
```