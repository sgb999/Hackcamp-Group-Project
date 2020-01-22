<?php
require_once ('Models/UsersDataSet.php');
require_once ('Models/User.php');
require_once ('Models/DBTimesheetEntryDataSet.php');
require_once ('Models/DBTimesheetEntry.php');
require_once ('Models/DBTimesheetDataSet.php');
require_once ('Models/DBTimesheet.php');
require_once ('Models/ProjectsDataSet.php');
require_once ('Models/Projects.php');
$projectID=implode($_GET); //TODO: check if project ID is empty
// get session information
$ID = $_SESSION['userID'];
$level = $_SESSION['userLevel'];

//get project information
$projectsDataSet = new ProjectsDataSet();
$project = $projectsDataSet->fetchDataByProject($projectID)[0]; //TODO: check if project exists
$view->projectName = $project->getPname();
$view->clientName = $project->getCname();
//information needed for uploading timesheets
$view->projectID = $project->getId();
$view->clientID = $project->getCid();
$view->userID = $ID;

// user data for who is in the project
$usersDataSet = new UsersDataSet();
$userArray = $usersDataSet->fetchDataByProject($projectID);
$view->users = $userArray;

//check if current user is in project
$userInProject = false;
foreach ($userArray as $user){
    if ($user->getUserID ==  $ID){
        $userInProject = true;
    }
}
$view->userInProject = $userInProject;

//get the user's graphs the user can display
$graphUserArray = Array();
if ($level == 0){ //if user
    $graphUserArray = $usersDataSet->fetchDataByUserID($ID) ;
} else { //if admin
    $graphUserArray = $usersDataSet->fetchDataByProject($projectID);
}


//store distance for user from timesheet entries
$userDistanceArray = Array();
//store worked hours for user from timesheet entries
$userTimeArray = Array();
//store worked hours for user from timesheet entries
$timesheetArray = Array();
//Class to return queries by timesheet entries
$timesheetDataSet = new DBTimesheetDataSet();

// for each user associated with this project
foreach($graphUserArray as $user){
    $timesheetDistanceArray = Array();
    $timesheetTimeArray = Array();

    // get user ID
    $userID = $user->getUserID();
    // get timesheets
    $timesheets = $timesheetDataSet->fetchDataByUserAndProject($userID, $projectID);

    foreach ($timesheets as $tkey => $timesheet){
        //retrive file link
        $timesheetArray[$timesheet->getId()] = $timesheet;

        // create arrays for the distance and time
        $distanceArray = array_fill(1, 31, 0);
        $timeWorkedArray = array_fill(1, 31, 0);

        $timesheet->getEntries();

        // get entries
        //$timesheetEntries = $entryDataSet->fetchDataByProjectAndUser($projectID,$userID);
        $timesheetEntries = $timesheet->getEntries();

        // for each entry associated with this user, store content in an array by date
        foreach ($timesheetEntries as $entry){
            $distanceArray[$entry->getDate()] = $entry->getDistance();
            $timeWorkedArray[$entry->getDate()] = $entry->getWorkingHours();
        }
        /* store the arrays as a string in an array sorted by user
        $userDistanceArray[$user->getUserID()] = implode(', ', $distanceArray);
        $userTimeArray[$user->getUserID()] = implode(', ', $timeWorkedArray);*/
        $timesheetID = $timesheet->getId();
        $timesheetDistanceArray[$timesheetID] = implode(', ', $distanceArray);
        $timesheetTimeArray[$timesheetID] = implode(', ', $timeWorkedArray);
    }
    $userDistanceArray[$user->getUserID()] = $timesheetDistanceArray;
    $userTimeArray[$user->getUserID()] = $timesheetTimeArray;
}

$view->userDistanceArray = $userDistanceArray;
$view->userTimeArray = $userTimeArray;

$view->timesheetArray = $timesheetArray;

//$allMySQL = $MySQL->getTimesheetsgraphs($projectID);
//$view->MySQL = $allMySQL;
require_once('Views/get-project.phtml');