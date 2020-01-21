<?php
//require_once 'lib/SimpleXLSX.php';
require_once '../Models/ExcelTimesheet.php';
require_once '../Models/ExcelTimesheetEntry.php';

if (isset($_POST['submit'])) { //not returning true

  $has_file = 1; //for testing set this once done //$_FILES['excel_file']['name'] != '' ? 1 : 0;

  if ($has_file) {

	$destination = $_SERVER['DOCUMENT_ROOT'] . '/tmp';
	$source = $_FILES['excel_file']['tmp_name'];
	$basename = basename($source);
	$target = $destination . "/$basename.xlsx"; // changed from xls
    
    move_uploaded_file($source, $target);

	require $_SERVER['DOCUMENT_ROOT'] . '/lib/SimpleXLSX.php';

    //test to parse the excel file
	$fileLink = 'tmp/timesheetLiam.xlsx'; //the excel file Kim gave us is an 'xls' not an 'xlsx', so I converted it in excel

	// once excel parsing works fine with timesheetLiam.xlsx, change
	// the above $fileLink variable to $target instead of 'tmp/timesheetLiam.xlsx'
	// like this: $fileLink = $target;

	// if ( $xlsx = SimpleXLSX::parse($fileLink) )
	if ( $timesheet = new ExcelTimesheet('../' . $fileLink) ) {
	    //echo $_POST['user_id'];
	    //echo  $_POST['project_id'];
	    //echo $_POST['client_id'];
	    $projectID = $_POST['user_id']; //get from view/controller
	    $userID = $_POST['project_id']; //get from view/controller
	    $clientID = $_POST['client_id']; //get from view/controller

	    // insert timesheet data into the database
	    $timesheet->insertInDatabase($projectID, $userID, $clientID, $fileLink);

	} else {
	  echo SimpleXLSX::parseError();
	}

    header('Location: /../get-project.php?projectID='$_POST['project_id'];);
  }
} else {

	header('Location: /');
}
