<?php

require_once ('Models/DataSet.php');
require_once ('Models/DBTimesheetEntry.php');

class DBTimesheetEntryDataSet extends DataSet {

    public function __construct() {
        parent::__construct();
    }

    // overrides from DataSet
    protected function convertToData($row) {
        return new DBTimesheetEntry($row);
    }

    public function fetchAll() {
        $sqlQuery = 'SELECT * FROM hackcamp8.timesheetEntries' . ' ' .
            'ORDER BY timesheetEntries.Date asc';

        return $this->fetchQuery($sqlQuery);
    }

    public function fetchDataByTimesheet($timesheetID) {

        $sqlQuery = 'SELECT * FROM hackcamp8.timesheetEntries '
            . 'WHERE timesheetEntries.timesheetID = ' . $timesheetID. ' ' .
            'ORDER BY timesheetEntries.Date asc';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    /* example query:
    SELECT * FROM hackcamp8.timesheetEntries
    INNER JOIN hackcamp8.timesheet ON hackcamp8.timesheet.timesheetID = hackcamp8.timesheetEntries.TimesheetID
    WHERE  timesheet.UserID = 4  AND timesheet.projectID =  3
    ORDER BY timesheetEntries.Date asc
    */
    public function fetchDataByProjectAndUser($projectID, $userID) {

        $sqlQuery = 'SELECT * FROM hackcamp8.timesheetEntries ' .
            'INNER JOIN hackcamp8.timesheet ON hackcamp8.timesheet.timesheetID = hackcamp8.timesheetEntries.TimesheetID ' .
            'WHERE  timesheet.UserID = ' . $userID . ' AND timesheet.projectID  = ' . $projectID . ' ' .
            'ORDER BY timesheetEntries.Date asc';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }



    public function fetchTotalHoursByTimesheet($timesheetID) {

        $sqlQuery = $sqlQuery = 'SELECT SUM(WorkedHours) FROM hackcamp8.timesheetEntries '
            . 'WHERE timesheetEntries.timesheetID = ' . $timesheetID;

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function fetchTotalDistanceByTimesheet($timesheetID) {

        $sqlQuery = $sqlQuery = 'SELECT SUM(TravelDistanceKM) FROM hackcamp8.timesheetEntries '
            . 'WHERE timesheetEntries.timesheetID = ' . $timesheetID;

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }

    public function insertTimesheet($timesheetID, $date, $workedHours, $travelDistanceKM, $other){
        $sqlQuery = "INSERT INTO hackcamp8.timesheetEntries (TimesheetID, Date, WorkedHours, TravelDistanceKM, Other)
                    VALUES ($timesheetID, $date, $workedHours, $travelDistanceKM, '$other')";
        return $this->executeQuery($sqlQuery);
    }
}


