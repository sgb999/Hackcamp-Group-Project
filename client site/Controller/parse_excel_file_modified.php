<?
//require_once 'lib/SimpleXLSX.php';
require_once 'Model/ExcelTimesheet.php';
require_once 'Model/ExcelTimesheetEntry.php';

if (isset($_POST['submit'])) {

  $has_file = $_FILES['excel_file']['name'] != '' ? 1 : 0;

  if ($has_file) {

    $destination = $_SERVER['DOCUMENT_ROOT'] . '/tmp';
    $source = $_FILES['excel_file']['tmp_name'];
    $target = "$destination/$source.xlsx"; // changed from xls
    
    move_uploaded_file($source, $target);

    require $_SERVER['DOCUMENT_ROOT'] . '/lib/SimpleXLSX.php';

    //test to parse the excel file
	$fileLink = 'tmp/timesheetLiam.xlsx'; //the excel file Kim gave us is an 'xls' not an 'xlsx', so I converted it in excel
	// if ( $xlsx = SimpleXLSX::parse($fileLink) )
	if ( $timesheet = new ExcelTimesheet($fileLink) ) {
	  echo $timesheet->getTimesheetOf() ."\n";
	  echo $timesheet->getPeriod() ."\n";
	  echo $timesheet->getClient() ."\n";
	  echo $timesheet->getTotal() ."\n";
	  foreach ( $timesheet->getTimesheetEntries() as $entry){
		  echo $entry->getDate() ."\n";
		  echo $entry->getWorkingHours() ."\n";
		  echo $entry->getDistance() ."\n";
		  echo $entry->getOther() ."\n" ."\n";
	  }
		echo $timesheet->getTotal() ."\n";
		echo $timesheet->getApprovedBy() ."\n";
		echo $timesheet->getComments() ."\n";

	} else {
	  echo SimpleXLSX::parseError();
	}

    header('Location: /');
  }
} else {
  header('Location: /');
}
