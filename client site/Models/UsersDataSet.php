<?php

require_once ('DataSet.php');
require_once ('User.php');

class UsersDataSet extends DataSet {

    public function __construct() {
        parent::__construct();
    }

    // overrides from DataSet
    protected function convertToData($row) {
        return new User($row);
    }

    public function fetchAll() {
        $sqlQuery = 'SELECT users.* ' .
            'FROM hackcamp8.users ' .
            'ORDER BY users.lastName ASC';

        return $this->fetchQuery($sqlQuery);
    }

    public function fetchDataByUserName($userName) {

        $sqlQuery = 'SELECT users.* ' .
            'FROM hackcamp8.users ' .
            'WHERE users.username = ' . $userName . ' ' .
            'ORDER BY users.lastName ASC';

        $dataSet = $this->fetchQuery($sqlQuery);
        return current($dataSet);
    }

    public function fetchDataByProject($projectID)
    {

        $sqlQuery = 'SELECT users.* ' .
            'FROM hackcamp8.users ' .
            'INNER JOIN hackcamp8.teams ON hackcamp8.teams.userID = hackcamp8.users.userID ' .
            'INNER JOIN hackcamp8.project ON hackcamp8.teams.teamNumber = hackcamp8.project.teamNumber ' .
            'WHERE hackcamp8.project.projectID = ' . $projectID . ' ' .
            'ORDER BY users.lastName ASC';

        $dataSet = $this->fetchQuery($sqlQuery);
        return current($dataSet);
    }
}


