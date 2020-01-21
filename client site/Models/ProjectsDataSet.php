<?php

require_once ('Models/DataSet.php');
require_once ('Models/Projects.php');

class ProjectsDataSet extends DataSet {

    public function __construct() {
        parent::__construct();
    }

    // overrides from DataSet
    protected function convertToData($row) {
        return new Projects($row);
    }

    public function fetchAll() {
        $sqlQuery = 'SELECT project.*, client.clientName ' .
            'FROM hackcamp8.project ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.project.clientID = hackcamp8.client.clientID ' .
            'ORDER BY project.projectDate desc';

        return $this->fetchQuery($sqlQuery);
    }

    public function fetchDataByClient($clientID) {

        $sqlQuery = 'SELECT project.*, client.clientName ' .
            'FROM hackcamp8.project ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.project.clientID = hackcamp8.client.clientID ' .
            'WHERE hackcamp8.project.clientID = ' . $clientID . ' ' .
            'ORDER BY project.projectDate desc';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function fetchDataByProject($projectID) {

        $sqlQuery = 'SELECT project.*, client.clientName ' .
            'FROM hackcamp8.project ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.project.clientID = hackcamp8.client.clientID ' .
            'WHERE hackcamp8.project.projectID = ' . $projectID. ' ' .
            'ORDER BY project.projectDate desc';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function fetchDataByTeamNumber($teamNumber) {

        $sqlQuery = 'SELECT project.*, client.clientName ' .
            'FROM hackcamp8.project ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.project.clientID = hackcamp8.client.clientID ' .
            'WHERE hackcamp8.timesheet.teamNumber = ' . $teamNumber. ' ' .
            'ORDER BY project.projectDate desc';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function fetchDataByTeamNumberAndUserID($teamNumber, $userID) {

        $sqlQuery = 'SELECT project.*, client.clientName ' .
            'FROM hackcamp8.project ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.project.clientID = hackcamp8.client.clientID ' .
            'INNER JOIN hackcamp8.teams ON hackcamp8.project.teamNumber = hackcamp8.teams.teamNumber ' .
            'WHERE hackcamp8.timesheet.teamNumber = ' . $teamNumber. ' AND teams.userID = ' . $userID . ' ' .
            'ORDER BY project.projectDate desc';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function fetchDataByUserID($userID) {

        $sqlQuery = 'SELECT project.*, client.clientName ' .
            'FROM hackcamp8.project ' .
            'INNER JOIN hackcamp8.client ON hackcamp8.project.clientID = hackcamp8.client.clientID ' .
            'INNER JOIN hackcamp8.teams ON hackcamp8.project.teamNumber = hackcamp8.teams.teamNumber ' .
            'WHERE teams.userID = ' . $userID . ' ' .
            'ORDER BY project.projectDate desc';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function insertProject($name, $clientID, $teamNumber)
    {

        $sqlQuery = "INSERT INTO hackcamp8.project(projectName, clientID, teamNumber, projectDate) 
                    VALUES('$name', '$clientID', '$teamNumber', NOW())";
    }
}


