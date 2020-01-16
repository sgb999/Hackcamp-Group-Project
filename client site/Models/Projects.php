<?php


class Projects
{
    private $_id, $_Pname, $_Tnum, $_Cid, $_Cname, $_Pdate, $_Users;

    public function __construct($dbRow)
    {
        $this->_id = $dbRow['projectID'];
        $this->_Pname = $dbRow['projectName'];
        $this->_Tnum = $dbRow['teamNumber'];
        $this->_Pdate = $dbRow['projectDate'];
        $this->_Cid = $dbRow['clientID'];
        $this->_Cname = $dbRow['clientName'];
        $this->_Users = Array();
    }

    private function retrieveUsers($projectID)
    {
        $usersDataSet = new UsersDataSet();
        $usersInProject = $usersDataSet->fetchDataByProject();
        $this->_Users = $usersInProject;
        return $usersInProject;
    }

    public function getId()
    {
        return $this->_id;
    }
    public function getPname()
    {
        return $this->_Pname;
    }
    public function getTnum()
    {
        return $this->_Tnum;
    }
    public function getCid()
    {
        return $this->_Cid;
    }
    public function getCname()
    {
        return $this->_Cname;
    }
    public function getPdate()
    {
        return $this->_Pdate;
    }

    public function getUsers(){
        // TODO: if statement to pull from users array if it is set
        $this->retrieveUsers($this->_id);
        return $this->retrieveUsers($this->_id);;
    }
}