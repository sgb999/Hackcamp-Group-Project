<?php

require_once ('Model/DataSet.php');
require_once ('Model/DBTimesheetEntry.php');

class DBTimesheetEntryDataSet extends DataSet {

    public function __construct() {
        parent::__construct();
    }

    // overrides from DataSet
    protected function convertToData($row) {
        return new DBTimesheetEntry($row);
    }

    public function fetchAll() {
        $sqlQuery = 'SELECT * FROM hackcamp8.timesheetEntries';

        return $this->fetchQuery($sqlQuery);
    }

    public function fetchDataByTimesheet($timesheetID) {

        $sqlQuery = $sqlQuery = 'SELECT * FROM hackcamp8.timesheetEntries '
            . 'WHERE timesheetEntries.timesheetID = ' . $timesheetID;

        $dataSet = $this->fetchQuery($sqlQuery);
        return current($dataSet);
    }
}

