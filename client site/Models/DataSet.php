<?php

require_once ('Database.php');

abstract class DataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    protected function fetchQuery($sqlQuery) {

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];
        while ($row = $statement->fetch()) {
            array_push($dataSet, $this->convertToData($row));
        }
        return $dataSet;
    }

    protected function executeQuery($sqlQuery) {

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        return $statement->execute(); // execute the PDO statement
    }

    protected function getLastID() {

        return $id = $this->_dbHandle->lastInsertId();
    }

    protected function getLastIDWithName($name) {

        return $id = $this->_dbHandle->lastInsertId($name);
    }

    // converts the row to the corresponding data object
    abstract protected function convertToData($row);
}


