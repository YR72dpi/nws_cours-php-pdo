
```php

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
    private function connect() : void {
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
