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
    public function getMyTeamNumbers($ID){
        $sqlQuery = "SELECT  teamNumber FROM teams WHERE userID = $ID";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet =  $statement->fetchAll();
        return $dataSet;
    }
    public function getTeamNumbers(){
        $sqlQuery = "SELECT DISTINCT  teamNumber FROM teams";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet =  $statement->fetchAll();
        return $dataSet;
    }
    public function getMyProject($Number, $userID){
        $sqlQuery = "SELECT projectID, projectName, clientName, teams.teamNumber FROM project, client, teams WHERE project.teamNumber = $Number AND project.teamNumber = teams.teamNumber AND teams.userID = $userID";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetchAll();
    }
    public function checkClient($clientName){
        $sqlQuery = "SELECT clientID FROM client WHERE clientName = '".$clientName."')";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetch();
    }
    public function createClient($clientName){
            $sqlQuery = "INSERT INTO client(clientName) VALUES('$clientName')";
            $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
            return $statement;

    }
    public function getClientID($clientName){
        $sqlQuery = "SELECT clientID FROM client WHERE clientName = '$clientName'";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
    public function createTeam($userID, $num){
        $sqlQuery = "INSERT INTO teams(userID, teamNumber) VALUES('$userID', '$num')";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }

    public function getUserID($userID){
        $sqlQuery = "SELECT userID FROM hackcamp8.users WHERE username = '$userID'";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet =  $statement->fetch();
        return $dataSet;

    }
    public function createProject($projectName, $clientID, $teamNumber){
        $sqlQuery = "INSERT INTO project(projectName, clientID, teamNumber, projectDate) VALUES('$projectName', '$clientID', '$teamNumber', NOW())";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
}