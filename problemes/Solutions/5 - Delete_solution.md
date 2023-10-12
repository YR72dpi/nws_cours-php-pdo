```php
/* 
    /!\ Return true si bien supprimé ou déjà supprimé
*/
public function delete(string $table, int $id): bool {
    $sql = "DELETE FROM $table WHERE id = :id";
    $prepare = $this->pdo->prepare($sql);
    $prepare->bindParam(':id', $id, PDO::PARAM_INT);

    try {
        $prepare->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return false;
}
```