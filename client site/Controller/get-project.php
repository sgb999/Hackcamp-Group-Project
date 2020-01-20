<?php
require_once ('Models/UsersDataSet.php');
require_once ('Models/User.php');
require_once ('Models/DBTimesheetEntryDataSet.php');
require_once ('Models/DBTimesheetEntry.php');
$projectID=implode($_GET); //TODO: check if project ID is empty
$ID = $_SESSION['userID'];
$level = $_SESSION['userLevel'];
// user data for who is in the project
$usersDataSet = new UsersDataSet();
$userArray = $usersDataSet->fetchDataByProject($projectID);
$view->users = $userArray;

//get the user's graphs the user can display
$graphUserArray = Array();
if ($level = 0){ // if normal user
    $graphUserArray = $ID;
} else { //if admin
    $graphUserArray = $userArray;
}

//store distance for user from timesheet entries
$userDistanceArray = Array();
//store worked hours for user from timesheet entries
$userTimeArray = Array();
//Class to return queries by timesheet entries
$entryDataSet = new DBTimesheetEntryDataSet();

// for each user associated with this project
foreach($graphUserArray as $user){
    // create arrays for the distance and time
    $distanceArray = Array();
    $timeWorkedArray = Array();
    // get user ID
    $userID = $user->getUserID();
    // get entries
    // TODO: check if the timesheet exists
    $timesheetEntries = $entryDataSet->fetchDataByProjectAndUser($projectID,$userID);

    //seed arrays with null values
    for ($i = 1; $i <= 31; $i++){
        $distanceArray[$i] = 0;
        $timeWorkedArray[$i] = 0;
    }

    // for each entry associated with this user, store content in an array by date
    foreach ($timesheetEntries as $entry){
        $distanceArray[$entry->getDate()] = $entry->getDistance();
        $timeWorkedArray[$entry->getDate()] = $entry->getWorkingHours();
    }
    // store the arrays as a string in an array sorted by user
    $userDistanceArray[$user->getUserID()] = implode(', ', $distanceArray);
    $userTimeArray[$user->getUserID()] = implode(', ', $timeWorkedArray);
}
$view->userDistanceArray = $userDistanceArray;
$view->userTimeArray = $userTimeArray;

// TODO: send $userDistanceArray and $userTimeArray to the view

//$allMySQL = $MySQL->getTimesheetsgraphs($projectID);
//$view->MySQL = $allMySQL;
require_once('Views/get-project.phtml');