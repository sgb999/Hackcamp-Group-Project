<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . 'lib/SimpleXLSX.php';

class ExcelTimesheet
{
    //variables
    protected $xlsx;
    protected $rows;

    protected  $timesheetOf = "";
    protected  $period = "";
    protected  $client = "";
    protected  $total;
    protected  $approvedBy = "";
    protected  $comments = "";
    // array of ExcelTimesheetEntries
    protected $timesheetEntries = Array();

    // constructor
    public function __construct(string $fileLink)
    {
        // if we need to get rid of empty rows we can use:
        // $xlsx = SimpleXLSX::parse($fileLink, false, false, true)
        if ($test = SimpleXLSX::parse($fileLink))
        {
            $this->xlsx = $test;
            $this->rows = $this->xlsx->rows();

            // set variables
            $this->setTimesheetOf();
            $this->setPeriod();
            $this->setClient();
            $this->setTotal();
            $this->setTimesheetEntry();
            $this->setApprovedBy();
            $this->setComments();

        } else { // ask about error handling
            static $error = false;
            return $error;
        }
        return true;
    }

    //concatenate all columns in a row together
    private function getFieldByRow($row, $colStart, $colEnd){
        $out = "";
        for ($col = $colStart; $col <= $colEnd; $col++) {
            $out .= $this->rows[$row] [$col];
        }
        return $out;
    }

    //concatenate all columns in a block of rows together
    private function getFieldByBlock($rowStart, $rowEnd, $colStart, $colEnd, $firstColumnStart){
        $out = "";

        for ($row = $rowStart; $row <= $rowEnd; $row++){
            for ($col = $colStart; $col <= $colEnd; $col++){
                if ($row == $rowStart && $col == $colStart){
                    $col = $firstColumnStart;
                }
                $out .= $this->rows[$row] [$col];
            }
        }
        $this->total = $out;
        return $out;
    }

    private function setTimesheetOf() {
        $row = 6 - 1; //primary cell is D6
        $out = $this->getFieldByRow($row, 1, 7);
        $this->timesheetOf = $out;
    }

    private function setPeriod() {
        $row = 7 - 1; //primary cell is D7
        $out = $this->getFieldByRow($row, 1, 7);
        $this->period = $out;
    }

    private function setClient() {
        $row = 8 - 1; //primary cell is D8
        $out = $this->getFieldByRow($row, 1, 7);
        $this->client = $out;
    }

    private function setTotal() {
        $row = 42 - 1;
        $col = 1;
        $total = $this->rows[$row][$col];
        $this->total = $total;
    }

    private function setTimesheetEntry() {
        $rowStart = 11 - 1;
        $rowEnd = 41 - 1;

        for($row = $rowStart; $row <= $rowEnd; $row++){
            $timeEnt = new ExcelTimesheetEntry($this->rows[$row]);
            array_push($this->timesheetEntries, $timeEnt);
        }
    }

    private function setApprovedBy() {
        $rowStart = 45 - 1;
        $rowEnd = 47 - 1;

        $firstColumnStart = 1;
        $columnStart = 0;
        $columnEnd = 2;

        $out = $this->getFieldByBlock($rowStart, $rowEnd, $columnStart, $columnEnd, $firstColumnStart);

        $this->approvedBy = $out;
    }

    private function setComments() {
        $rowStart = 45 - 1;
        $rowEnd = 50 - 1;

        $firstColumnStart = 4;
        $columnStart = 3;
        $columnEnd = 7;

        $out = $this->getFieldByBlock($rowStart, $rowEnd, $columnStart, $columnEnd, $firstColumnStart);

        $this->comments = $out;
    }

    /**
     * @return string
     */
    public function getTimesheetOf(): string
    {
        return $this->timesheetOf;
    }

    /**
     * @return string
     */
    public function getPeriod(): string
    {
        return $this->period;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @return array
     */
    public function getTimesheetEntries(): array
    {
        return $this->timesheetEntries;
    }

    /**
     * @return string
     */
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * @return string
     */
    public function getApprovedBy(): string
    {
        return $this->approvedBy;
    }

    /**
     * @return string
     */
    public function getComments(): string
    {
        return $this->comments;
    }

}