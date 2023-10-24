<?php
require_once("./Lib/PDOManagerInterface.php");

class PDOManagerClass implements PDOManagerInterface
{

    // To Edit
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    
    
    private $db_name;
    private $pdo;
    private PDOStatement $prepare;
    private array $mariadbToPdoTypeMap = [
        // Integer Types
        'tinyint' => PDO::PARAM_INT,
        'smallint' => PDO::PARAM_INT,
        'mediumint' => PDO::PARAM_INT,
        'int' => PDO::PARAM_INT,
        'integer' => PDO::PARAM_INT,
        'bigint' => PDO::PARAM_INT,
    
        // Floating-Point Types
        'float' => PDO::PARAM_STR,
        'double' => PDO::PARAM_STR,
        'decimal' => PDO::PARAM_STR,
    
        // String Types
        'char' => PDO::PARAM_STR,
        'varchar' => PDO::PARAM_STR,
        'text' => PDO::PARAM_STR,
        'tinytext' => PDO::PARAM_STR,
        'mediumtext' => PDO::PARAM_STR,
        'longtext' => PDO::PARAM_STR,
    
        // Binary Types
        'binary' => PDO::PARAM_LOB,
        'varbinary' => PDO::PARAM_LOB,
        'blob' => PDO::PARAM_LOB,
        'tinyblob' => PDO::PARAM_LOB,
        'mediumblob' => PDO::PARAM_LOB,
        'longblob' => PDO::PARAM_LOB,
    
        // Date and Time Types
        'date' => PDO::PARAM_STR,
        'datetime' => PDO::PARAM_STR,
        'timestamp' => PDO::PARAM_STR,
        'time' => PDO::PARAM_STR,
        'year' => PDO::PARAM_INT,
    
        // Other Types
        'boolean' => PDO::PARAM_BOOL,
        'bool' => PDO::PARAM_BOOL,
        'enum' => PDO::PARAM_STR,
        'set' => PDO::PARAM_STR,
        'json' => PDO::PARAM_STR,
    ];
    private array $mysqlToPhpTypeMapping = [
        'TINYINT' => 'integer',
        'SMALLINT' => 'integer',
        'MEDIUMINT' => 'integer',
        'INT' => 'integer',
        'BIGINT' => 'integer',
        'FLOAT' => 'float',
        'DOUBLE' => 'double',
        'DECIMAL' => 'float',
        'CHAR' => 'string',
        'VARCHAR' => 'string',
        'TEXT' => 'string',
        'TINYTEXT' => 'string',
        'MEDIUMTEXT' => 'string',
        'LONGTEXT' => 'string',
        'DATE' => 'string',
        'TIME' => 'string',
        'DATETIME' => 'string',
        'TIMESTAMP' => 'string',
        'YEAR' => 'string',
        'BINARY' => 'string',
        'VARBINARY' => 'string',
        'BLOB' => 'string',
        'TINYBLOB' => 'string',
        'MEDIUMBLOB' => 'string',
        'LONGBLOB' => 'string',
        'ENUM' => 'string',
        'SET' => 'string',
        'BOOL' => 'bool',
        'BOOLEAN' => 'bool',
    ];

    private string|null $currentTableDescribe = null;
    private array|null $tableDesc;

    public function __construct(string $DBName)
    {
        $this->db_name = $DBName;
        $this->connect();
    }

    private function orderBy(array|null $order):string {
        if (!is_null($order)) {
            $arrayIndex = array_keys($order);
            $orderByQuery = "  ORDER BY " . $arrayIndex[0] . " " . $order[$arrayIndex[0]];
        }
        return $orderByQuery ?? "";
    }

    private function where(array $criteria):string {
        if (count($criteria) > 0) {
            $whereQuery = " WHERE ";

            $n = 0;
            foreach ($criteria as $index => $value) {
                $whereQuery .= $index . " = '" . $value . "'";

                if ($n < count($criteria) - 1) {
                    $whereQuery .= " AND ";
                }
                $n++;
            }
        }

        return $whereQuery ?? "";
    }
    
    private function getTableDesc(string $table): array|bool
    {
        $query = "DESC $table";
        try {
            $data = $this->pdo->query($query)->FetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            throw new Exception($th->getMessage()); // Corrected error message
        }
        foreach ($data as $key => $tableColumn) {
                $mariaDBType = $tableColumn["Type"];
                $mariaDBType = preg_replace('/(\(.*\))/', '', $mariaDBType);
                $data[$key]["Type"] = $mariaDBType;
        }
        return $data;
    }

    private function paramBinder(string $table, string $column, mixed $value): bool {
        if($this->currentTableDescribe === null || $this->currentTableDescribe !== $table) {
            if($tableDesc = $this->getTableDesc($table)) {
                $this->currentTableDescribe = $table;
                $this->tableDesc = $tableDesc;
            } else {
                throw new Exception("Maybe the table $table doesn't exist", 1);
                return false;
            }
        }

        $goodType = false;
        foreach ($this->tableDesc as $key => $tableColumn) {
            if($tableColumn["Field"] === $column) {
                $phpTypeForTable = $this->mysqlToPhpTypeMapping[strtoupper($tableColumn["Type"])];

                if(gettype($value) === $phpTypeForTable) {
                    $goodType = true;
                    break;
                }
            }
        }

        try {
            
            if($goodType) {
                $value = htmlspecialchars($value);
                return $this->prepare->bindParam(":".$column, $value);
            } else {
                throw new Exception("Erreur de type pour $column", 1);
                
                return false;
            }
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 1);
            return false;
        }
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
        $this->prepare = $this->pdo->prepare($query);
        // les bind param
        $this->prepare->execute();
        while ($line = $this->prepare->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $line;
        }
        return $data;
    }


    public function findBy(string $table, array $criteria, array $order = null): array
    {
        $data = [];
        $query = "SELECT * FROM $table";
        $query .= $this->where($criteria);
        $query .= $this->orderBy($order);
        $this->prepare = $this->pdo->prepare($query);
        $this->prepare->execute();
        while ($line = $this->prepare->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $line;
        }
        return $data;
    }

    public function post(string $table, array $columnData): bool
    {
        $query = "INSERT INTO " . $table . " ";

        $columns = array_keys($columnData);
        $values = array_values($columnData);

        $query .= "(".implode(", ", $columns) . ") VALUES (:" . implode(", :", $columns) . ")";

        $this->prepare = $this->pdo->prepare($query);

        foreach ($columnData as $column => &$value) {
            $this->paramBinder($table, $column, $value);
        }

        try {
            $this->prepare->execute();
            return true;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

        return false;
    }

    public function delete(string $table, int $id): bool {
        $query = "DELETE FROM $table WHERE id = :id";
        $this->prepare = $this->pdo->prepare($query);
        // $prepare->bindParam(':id', $id, PDO::PARAM_INT);
        $this->paramBinder($table, "id", $id);

        try {
            $this->prepare->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return false;
    }
    
    public function deleteMany(string $table, array $ids):array {
        $ok = [];
        foreach($ids as $id) $ok[] = $this->delete($table, $id);
        return $ok;
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

        $this->prepare = $this->pdo->prepare($query);
        // $prepare->bindParam(':id', $id, PDO::PARAM_INT);
        $this->paramBinder($table, $column, $value);

        try {
            $this->prepare->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return false;
    }

    public function getRelation(array $relation, string $select = null, array $criteria, array $order = null): array {
        $primaryTable = $relation[0];
        $secondaryTable = $relation[1];

        $query = "SELECT * FROM $primaryTable[0]";
        if(!is_null($select)){
            $query = "SELECT $select FROM $primaryTable[0]";
        }

        $query .= " INNER JOIN $secondaryTable[0] ON $primaryTable[0].$primaryTable[1] = $secondaryTable[0].$secondaryTable[1]";


        $query .= $this->where($criteria);

        $query .= $this->orderBy($order);

        $this->prepare = $this->pdo->prepare($query);
        $this->prepare->execute();
        while ($line = $this->prepare->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $line;
        }
        return $data;
    }
}