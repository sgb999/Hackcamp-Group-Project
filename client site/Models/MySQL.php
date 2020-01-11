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
        $sqlQuery = "SELECT userID, username, userLevel FROM hackcamp8.users WHERE username = '".$sqlQuery1."' AND pass = sha1('".$sqlQuery2."')";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetch();
    }
    public function addUser($sqlQuery1, $sqlQuery2, $sqlQuery3, $sqlQuery4, $sqlQuery5, $sqlQuery6)
    {
        $sqlQuery = "INSERT INTO hackcamp8.users(username, firstName, lastName, pass, email, userLevel, userDate) VALUES('$sqlQuery1', '$sqlQuery2','$sqlQuery3', sha1('$sqlQuery4'), '$sqlQuery5', '$sqlQuery6', NOW())";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
    public function getMyProject(){
        $sqlQuery = "SELECT * FROM project ORDER BY ASC ";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
}