<?php

class Database
{
    protected $pdo;

    /**
     * Database constructor.
     *
     * @param $dsn
     * @param $user
     * @param $password
     * @throws DatabaseConnectionException
     */
    public function __construct($dsn, $user, $password) {
        try {
            $this->pdo = new PDO($dsn, $user, $password, [

            ]);
        } catch (PDOException $e) {
            throw new DatabaseConnectionException("Couldn't connect to the database...");
        }
    }

    public function select($table, $wheres) {

        // ['field' => 'value']
        // SELECT * FROM users WHERE field=value

        // ['field1' => 'value1', 'field2' => 'value2']
        // SELECT * FROM users WHERE field1=value1 AND field2=value2

        $whereList = [];
        foreach ($wheres as $key => $value)
            $whereList[] = $key."=".$value;

        return $this->pdo
            ->query("SELECT * FROM ".$table." WHERE ".implode(' AND ', $whereList));

          return $this;
      }


      public function single()
      {
        return $this->pdo->fetch(PDO::FETCH_OBJ);
      }

      public function all()
      {
        return $this->pdo->fetchAll(PDO::FETCH_OBJ);
      }

    public function __destruct() {
        $this->pdo = null;
    }
}
