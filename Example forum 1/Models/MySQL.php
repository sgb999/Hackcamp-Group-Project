<?php
require_once('Database.php');
class MySQL
{
    protected $_dbConnection, $_dbInstance;


    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

}