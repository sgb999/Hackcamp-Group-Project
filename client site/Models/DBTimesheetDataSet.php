<?php

require_once ('Model/DataSet.php');
require_once ('Model/DBTimesheet.php');

class DBTimesheetDataSet extends DataSet {

    public function __construct() {
        parent::__construct();
    }

    // overrides from DataSet
    protected function convertToData($row) {
        return new DBTimesheet($row);
    }

    public function fetchAll() {
        $sqlQuery = 'SELECT timesheet.*, client.clientName, CONCAT(users.firstName, " ", users.lastName) as fullName ' .
            'FROM hackcamp8.timesheet ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.timesheet.ClientID = hackcamp8.client.clientID ' .
            'INNER JOIN hackcamp8.users ON hackcamp8.timesheet.UserID = hackcamp8.users.UserID';

        return $this->fetchQuery($sqlQuery);
    }

    public function fetchDataByUserAndProject($userID, $projectID) {

        $sqlQuery = 'SELECT timesheet.*, client.clientName, CONCAT(users.firstName, " ", users.lastName) as fullName ' .
            'FROM hackcamp8.timesheet ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.timesheet.ClientID = hackcamp8.client.clientID ' .
            'INNER JOIN hackcamp8.users ON hackcamp8.timesheet.UserID = hackcamp8.users.UserID ' .
            'WHERE hackcamp8.timesheet.UserID = ' . $userID . ' AND hackcamp8.timesheet.projectID = ' . $projectID;

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function fetchDataByProject($projectID) {

        $sqlQuery = 'SELECT timesheet.*, client.clientName, CONCAT(users.firstName, " ", users.lastName) as fullName ' .
            'FROM hackcamp8.timesheet ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.timesheet.ClientID = hackcamp8.client.clientID ' .
            'INNER JOIN hackcamp8.users ON hackcamp8.timesheet.UserID = hackcamp8.users.UserID ' .
            'WHERE hackcamp8.timesheet.projectID = ' . $projectID;

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function fetchDataByUser($userID) {

        $sqlQuery = 'SELECT timesheet.*, client.clientName, CONCAT(users.firstName, " ", users.lastName) as fullName ' .
            'FROM hackcamp8.timesheet ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.timesheet.ClientID = hackcamp8.client.clientID ' .
            'INNER JOIN hackcamp8.users ON hackcamp8.timesheet.UserID = hackcamp8.users.UserID ' .
            'WHERE hackcamp8.timesheet.UserID = ' . $userID;

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function insertTimesheet($timesheetID, $projectID, $userID, $clientID, $period, $approvedBy, $name, $comments, $fileLink){
        $sqlQuery = "INSERT INTO hackcamp8.timesheet (timesheetID, projectID, UserID, ClientID, Period, ApprovedBy, Name, Comments, FileLink)
        VALUES ($timesheetID, $projectID, $userID, $clientID, '$period', '$approvedBy', '$name', '$comments', '$fileLink')";
    }
}


