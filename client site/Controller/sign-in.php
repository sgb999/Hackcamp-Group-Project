<?php
require_once ('Models/MySQL.php');
if (isset($_POST['submit'])) {
    require 'validation.php';
    if (validate_length($_POST['username'], 3, 20) && validate_length($_POST['pass'], 7, 255)) {
        
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
            public function addUser($sqlQuery1, $sqlQuery2, $sqlQuery3)
            {
                $sqlQuery = "INSERT INTO hackcamp8.users(username, pass, email, user_date, user_level) VALUES('$sqlQuery1', sha1('$sqlQuery2'),'$sqlQuery3', NOW(), 0)";
                $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
                $statement->execute(); // execute the PDO statement
                return $statement;
            }
            public function getMyProject(){
                $sqlQuery = "SELECT * FROM project ";
            }
        } $userDataSet = new MySQL();
        $logUserIn = $userDataSet->login($_POST['username'],$_POST['pass']);
        if(!$logUserIn)
        {
            echo "Incorrect Username or Password";
        }
        else
        {
            $_SESSION['userID'] = $logUserIn['userID'];
            $_SESSION['username'] = $logUserIn['username'];
            $_SESSION['userLevel'] = $logUserIn['userLevel'];
            echo $_SESSION['userID'];
            echo $_SESSION['username'];
            echo $_SESSION['userLevel'];
            echo 'works';
            header("Location: /index.php");
        }
    }
}
require_once('../Views/sign-in.phtml');