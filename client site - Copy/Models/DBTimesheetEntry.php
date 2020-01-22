<?php


class DBTimesheetEntry
{
    protected $id;
    protected $timesheetID;

    protected $date;
    protected $workingHours;
    protected $distance;
    protected $other;


    // constructor
    // row is the first part of the associative array
    public function __construct(Array $dbRow)
    {
        $this->id = $dbRow['ID'];
        $this->timesheetID = $dbRow['TimesheetID'];
        $this->date = $dbRow['Date'];
        $this->workingHours = $dbRow['WorkedHours'];
        $this->distance = $dbRow['TravelDistanceKM'];
        $this->other = $dbRow['Other'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTimesheetID()
    {
        return $this->timesheetID;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getWorkingHours()
    {
        return $this->workingHours;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @return mixed
     */
    public function getOther()
    {
        return $this->other;
    }
}