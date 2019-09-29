<?php

namespace TvSeries\DAL\repositories\dbService;

use PDO;
use PDOException;

class DbConnectionService {

    private $databaseName = "tv_series";
    private $username = "root";
    private $password = "";
    private $serverName = "localhost";

    public $conn;
    private $error;

       function __construct() {
           try {
               $connectionString = "mysql:host=$this->serverName;dbname=$this->databaseName";
               $options = [
                   PDO::ATTR_PERSISTENT => true,
                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
               ];
               $this->conn = new PDO($connectionString, $this->username, $this->password, $options);
           } catch (PDOException $ex) {
               $this->error = $ex->getMessage();
               echo "Error: $this->error";
           }
       }
}