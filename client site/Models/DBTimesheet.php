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
    }

    private function returnIfExists(Array $array, string $index){
        if ( array_key_exists($array, $index)){
            return $array[$index];
        } else {
            return null;
        }
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

    public function getForumID() {
        return $this->_id;
    }
   
    public function getName() {
       return $this->_name;
    }
    
    public function getShortDescription() {
       return $this->_shortDescription; //remember to decrypt password
    }
    
    public function getDescription() {
       return $this->_description;
    }
}


