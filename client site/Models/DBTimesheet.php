<?php
require_once ('ExcelTimesheet.php');
class DBTimesheet {

    protected  $id;
    protected  $projectID;
    protected  $clientID;
    protected  $userID;
    protected  $timesheetOf;
    protected  $period;
    protected  $clientName;
    protected  $total;
    protected  $approvedBy;
    protected  $name;
    protected  $comments;
    protected  $fileLink;
    protected  $uplodeDate;
    protected  $entries = Array();
    protected  $entriesExist = false;

    public function __construct($dbRow) {
        $this->id = $this->returnIfExists($dbRow, 'timesheetID');
        $this->projectID = $this->returnIfExists($dbRow, 'projectID');
        $this->clientID = $this->returnIfExists($dbRow, 'ClientID');
        $this->userID = $this->returnIfExists($dbRow, 'UserID');
        $this->timesheetOf = $this->returnIfExists($dbRow, 'fullName');
        $this->period = $this->returnIfExists($dbRow, 'Period');
        $this->clientName = $this->returnIfExists($dbRow, 'clientName');
        $this->approvedBy = $this->returnIfExists($dbRow, 'ApprovedBy');
        $this->name = $this->returnIfExists($dbRow, 'Name');
        $this->comments = $this->returnIfExists($dbRow, 'Comments');
        $this->fileLink = $this->returnIfExists($dbRow, 'FileLink');
        $this->uplodeDate = $this->returnIfExists($dbRow, 'uploadDate');
    }

    private function returnIfExists(Array $array, String $index){
        if ( array_key_exists($array, $index)){
            return $array[$index];
        } else {
            return null;
        }
    }

    public function getEntries(){
        // get from entries array if it is set
        if ( $this->entriesExist == false) {
            $this->entries = $this->retrieveEntries($this->id);
            $this->entriesExist = true;
        }
        return $this->entries;
    }

    private function retrieveEntries($timesheetID)
    {
        $timesheetsDataSet = new DBTimesheetEntryDataSet();
        $entriesInTimesheet = $timesheetsDataSet->fetchDataByTimesheet($timesheetID);
        $this->entries = $entriesInTimesheet;
        $this->entriesExist = true;
        return $entriesInTimesheet;
    }

    public function convertExcelTimesheet(ExcelTimesheet $ts, $projectID, $clientID, $userID){
        // id is auto increment
        $this->projectID = $projectID;
        $this->clientID = $clientID;
        $this->userID = $userID;
        $this->timesheetOf = $ts->getTimesheetOf();
        $this->period = $ts->getPeriod();
        $this->clientName = $ts->getClientName();
        $this->approvedBy = $ts->getApprovedBy();
        $this->name = $ts->getName();
        $this->comments = $ts->getComments();
    }
   
    public function getName() {
       return $this->name;
    }



    /**
     * @return mixed|null
     */
    public function getClientID()
    {
        return $this->clientID;
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed|null
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed|null
     */
    public function getApprovedBy()
    {
        return $this->approvedBy;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return mixed|null
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return mixed|null
     */
    public function getTimesheetOf()
    {
        return $this->timesheetOf;
    }

    /**
     * @return mixed|null
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @return mixed|null
     */
    public function getProjectID()
    {
        return $this->projectID;
    }

    /**
     * @return mixed|null
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @return mixed|null
     */
    public function getFileLink()
    {
        return $this->fileLink;
    }

    /**
     * @return mixed|null
     */
    public function getUplodeDate()
    {
        return $this->uplodeDate;
    }
}


