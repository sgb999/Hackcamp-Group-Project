<?php
/*TODO: some errors need fixing:
    'approvedBy' might need modifying
  NOTE: this version of the class only works with Liam's version of the company excel timesheet
        if you want another version for the regular one then ask me
*/
class ExcelTimesheet
{
    //variables
    protected $xlsx;
    protected $rows;

    protected  $timesheetOf;
    protected  $period;
    protected  $client;
    protected  $total;
    protected  $approvedBy;
    protected  $name;
    protected  $comments;
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
            $this->setName();
            $this->setComments();

        } else { // ask about error handling
            static $error = false;
            return $error;
        }
        return true;
    }

    // given the numeric part of an excel row
    private function convertToRow(int $excelRowNumber): int{
        return $excelRowNumber - 1; // make the index 0-based
    }

    // given the alphabetical part of an excel column
    private function convertToColumn(String $excelColumnString): int{
        $chars[] = str_split($excelColumnString);
        $tempArr = Array();
        foreach ($chars as $char){
            $temp =  ord($char[0]) & 63; //get the character's position in the alphabet
            $temp -= 1; // make it zero-based
            array_push($tempArr, $temp);
        }
        return array_sum($tempArr);
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
        return $out;
    }

    private function setTimesheetOf() {
        $row = $this->convertToRow(6); //primary cell is D6
        $colStart = $this->convertToColumn('B');
        $colEnd = $this->convertToColumn('H');

        $out = $this->getFieldByRow($row, $colStart, $colEnd);
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

    private function setTimesheetEntry() {
        $rowStart = 10 - 1;
        $rowEnd = 40 - 1;

        for($row = $rowStart; $row <= $rowEnd; $row++){
            $timeEnt = new ExcelTimesheetEntry($this->rows[$row]);
            array_push($this->timesheetEntries, $timeEnt);
        }
    }

    private function setTotal() {
        $row = 41 - 1;
        $col = $this->convertToColumn('B');
        $total = $this->rows[$row][$col];
        $this->total = $total;
    }

    private function setApprovedBy() {
        $rowStart = 44 - 1;
        $rowEnd = 45 - 1;

        $firstColumnStart = 1;
        $columnStart = 0;
        $columnEnd = 2;

        $out = $this->getFieldByBlock($rowStart, $rowEnd, $columnStart, $columnEnd, $firstColumnStart);

        $this->approvedBy = $out;
    }

    private function setName() {
        $rowStart = 46 - 1;
        $rowEnd = 47 - 1;

        $firstColumnStart = 1;
        $columnStart = 0;
        $columnEnd = 2;

        $out = $this->getFieldByBlock($rowStart, $rowEnd, $columnStart, $columnEnd, $firstColumnStart);

        $this->name = $out;
    }

    private function setComments() {
        $rowStart = 44 - 1;
        $rowEnd = 47 - 1;

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

        return (string)$this->timesheetOf;
    }

    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return (string)$this->client;
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
        return (string)$this->total;
    }

    /**
     * @return string
     */
    public function getApprovedBy(): string
    {
        return (string)$this->approvedBy;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return (string)$this->name;
    }

    /**
     * @return string
     */
    public function getComments(): string
    {
        return (string)$this->comments;
    }

    public function getHTML()
    {
        $this->xlsx->toHTML();
    }

}
