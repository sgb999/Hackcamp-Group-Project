<?php


class ExcelTimesheetEntry
{
    protected $date;
    protected $workingHours;
    protected $distance;
    protected $other;


    // constructor
    // row is the first part of the associative array
    public function __construct(Array $row)
    {
        $this->date = $row[0];
        $this->workingHours = $row[1] . $row[2];
        $this->distance = $row[3];
        $this->distance = $row[4] . $row[5] . $row[6] . $row[7];
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getWorkingHours(): string
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