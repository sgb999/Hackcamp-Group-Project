<?php


class Projects
{
private $_id, $_Tid, $_Cid, $_Cname;

public function __construct($dbRow)
{
    $this->_id = $dbRow['projectID'];
    $this->_Tid = $dbRow['teamID'];
    $this->_Cid = $dbRow['clientID'];
    $this->_Cname = $dbRow['clientName'];
}
    public function getId()
    {
        return $this->_id;
    }
    public function getTid()
    {
        return $this->_Tid;
    }
    public function getCid()
    {
        return $this->_Cid;
    }
    public function getCname()
    {
        return $this->_Cname;
    }
}