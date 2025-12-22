<?php
class DB{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh; //Database Handler
    private $error;

    private $stmt;

    public function __construct(){
      //Set DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      //Set options
      $options = array(
        PDO::ATTR_PERSISTENT    => false,
        PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_LOCAL_INFILE => true
      );
      //Create a new PDO instance
      try {
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch (PDOException $e) { //Catch any errors
        $this->error = $e->getMessage();
      }
    }

    public function query($query){
      $this->stmt = $this->dbh->prepare($query);
    }

    //Binds the prep statement
    public function bind($param, $value, $type = null){
      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }
      }
      $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prep statement
    public function execute(){
      return $this->stmt->execute();
    }

    //Return result Set
    public function resultset(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Return a single record
    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Return number of affected rows
    public function rowCount(){
      return $this->stmt->rowCount();
    }

    //Return last inserted ID
    public function lastInsertId(){
      return $this->dbh->lastInsertId();
    }

    //Transaction method
    public function beginTransaction(){
      return $this->dbh->beginTransaction();
    }

    //Transaction method
    public function commit(){
      return $this->dbh->commit();
    }

      //Transaction method
      public function rollBack(){
        return $this->dbh->rollBack();
      }
}
