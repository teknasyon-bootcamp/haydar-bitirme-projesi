<?php

namespace Core;

abstract class Database
{
    private static $tableColumns = "";
    private static $tableValueParams = "";
    private static $tableSetParams = "";
    private static $tableName = "";

    // Connect the database and set tableName
    public static function connect()
    {
        // Create the pdo object 
        try {

            $dbHost = env('DB_HOST');
            $dbPort = env('DB_PORT');
            $dbName = env('DB_NAME');
            $dbUser = env('DB_USER');
            $dbPass = env('DB_PASS');

            $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName";

            $pdo = new \PDO($dsn, $dbUser, $dbPass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {
            exit("Veritabanına bağlanırken bir hata ile karşılaşıldı : {$ex->getMessage()}");
        }

        self::defineTableName();

        return $pdo;
    }

    public static function defineTableName()
    {
        //Define table name the will be using on queries
        if (static::$tableName) {
            // That means there is a custom tableName property variable on Model
            self::$tableName  = static::$tableName;
        } else {
            // That means that there isn't customization. It will be apply  default table naming 
            $modelPathName = strtolower(static::class);
            $modelName = str_replace("app\\models\\", "", $modelPathName);
            self::$tableName  = $modelName . 's';
        }
    }


    /**
     * Fetch all record as function's model the invoked 
     * 
     * Example : This function returns the Post model array if run like Post::All() 
     * Example : This function returns the User model array if run like User::All() 
     * 
     * @return static::class
     * */
    public static function All()
    {
        $query = self::connect()->query("SELECT * FROM " . self::$tableName . "");

        return $query->fetchAll(\PDO::FETCH_CLASS, static::class);
    }


    /**
     * Get child class object by id 
     * 
     * Return null if the record doesn't exist.
     * 
     * @param int $id
     * @return static::object|null
     * 
     */
    public static function find(int $id): static | null
    {
        self::defineTableName();
        $query = "SELECT * FROM " . self::$tableName . " WHERE id=:id";

        //Prepare query and bind variables
        $namedQuery = self::connect()->prepare($query);

        $namedQuery->bindValue(':id', $id);
        $namedQuery->execute();

        // Get record as static::object 
        $result = $namedQuery->fetchObject(static::class);

        $result = $result ?: null;

        return $result;
    }

    /**
     * Where clause
     * 
     * @param string $columnName 
     * @param string $value
     * 
     * @return PDOStatement
     */
    public static function where(array $values, ?string $customTableName = null)
    {
        if ($customTableName == null) {
            self::defineTableName();
            $customTableName = self::$tableName;
        }

        $whereSection = '';

        foreach ($values as $columnName => $value) {
            $whereSection .= "$columnName=:$columnName";
        }

        $pdoStatement = self::connect()->prepare("SELECT * FROM " . $customTableName . " WHERE $whereSection");
        

        foreach ($values as $columnName => $value) {
            $pdoStatement->bindParam(":$columnName", $value);
        }

        $pdoStatement->execute();

        self::$tableName = '';
        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    /**
     * Creates some parts of SQL Queries
     * 
     * I didn't use implode instead of this because implode add
     * comma even for an element and this breaks the SQL query
     * 
     * @return Array 
     */
    public function serialize(): array
    {
        // Get properties of static class as array
        $properties = get_object_vars($this);
        $totalProperties = count($properties);
        $propertiesCounter = 0;


        foreach ($properties as $columnName => $value) {

            // Ex : VALUES (:value1,:value2,:value3)
            self::$tableValueParams .= ":" . $columnName;
            // Ex : tableName (:column1,:column2,:column3) 
            self::$tableColumns .= $columnName;
            // Ex : SET column1 = :value1, column2 = :value2, column3 = :value3
            self::$tableSetParams .= "$columnName=:$columnName";

            $propertiesCounter++;

            // Don't add semicolon if this is last value of array
            if ($propertiesCounter < $totalProperties) {

                self::$tableSetParams .= ',';
                self::$tableValueParams .= ',';
                self::$tableColumns .= ',';
            }
        }
        return $properties;
    }

    // Create the record
    public function create()
    {
        // Serialize parts of the query
        $properties = $this->serialize();

        self::defineTableName();

        $connection = self::connect();
        $namedQuery = $connection->prepare("INSERT INTO " . self::$tableName . "(" . self::$tableColumns . ") VALUES(" . self::$tableValueParams . ")");

        // Bind params
        foreach ($properties as $param => $value) {
            $namedQuery->bindValue(":$param", $value);
        }

        $namedQuery->execute();

        return $connection->lastInsertId();
    }

    public function update()
    {
        // Serialize parts of the query
        $properties = $this->serialize();

        $query = "UPDATE " . self::$tableName . " SET " . self::$tableSetParams . " WHERE id=:id";
        $namedQuery = self::connect()->prepare($query);

        // Bind params
        foreach ($properties as $param => $value) {
            $namedQuery->bindValue(":$param", $value);
        }

        $namedQuery->execute();
    }

    public function delete()
    {
        // Connect the database
        self::connect();

        $query = "DELETE FROM " . self::$tableName . " WHERE id=:id";
        $namedQuery = self::connect()->prepare($query);

        // Bind id param
        $namedQuery->bindValue(":id", $this->id);

        $namedQuery->execute();
    }
}
