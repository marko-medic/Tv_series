<?php

namespace TvSeries\DAL\repositories\dbService;

class DbService {

    private $dbConnectionService;
    private $conn;
    private $query;

    public function __construct($dbConnectionService) {
       if (empty($dbConnectionService)) {
           throw new \InvalidArgumentException("DbConnectionService cannot be empty");
       }
       $this->dbConnectionService = $dbConnectionService;
    }

    public function query($sql) {
        $this->query = $this->dbConnectionService->conn->prepare($sql);
    }
    public function execute() {
        return $this->query->execute() or die("Something went wrong");
    }
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->query->bindValue($param, $value, $type);
    }
    public function getAll() {
        $this->execute();
        return $this->query->fetchAll();
    }
    public function getRow() {
        $this->execute();
        return $this->query->fetch();
    }
    public function getRowCount() {
        $this->execute();
        return $this->query->rowCount();
    }
    public function getColumnCount() {
        $this->execute();
        return $this->query->columnCount();
    }
}
