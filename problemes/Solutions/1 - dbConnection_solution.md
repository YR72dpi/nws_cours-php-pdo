[< Retour](../../README.md)
```php
class PDOManagerClass {

    // Information de connection à la db à modifier
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';

    private $db_name;
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
}
```
