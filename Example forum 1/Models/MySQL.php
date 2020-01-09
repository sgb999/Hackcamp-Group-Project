<?php
require_once('Database.php');
class MySQL
{
    protected $_dbConnection, $_dbInstance;


    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }
    public function login($sqlQuery1, $sqlQuery2)
    {
        $sqlQuery = "SELECT user_id, user_name, user_level FROM users WHERE user_name = '".$sqlQuery1."' AND user_pass = sha1('".$sqlQuery2."')";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetch();
    }
    public function addUser($sqlQuery1, $sqlQuery2, $sqlQuery3)
    {
        $sqlQuery = "INSERT INTO users(user_name, user_pass, user_email, user_date, user_level) VALUES('$sqlQuery1', sha1('$sqlQuery2'),'$sqlQuery3', NOW(), 0)";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
}