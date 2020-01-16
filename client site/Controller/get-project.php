<?php
require_once ('Models/UsersDataSet.php');
require_once ('Models/User.php');
$projectID=implode($_GET);
$projectsDataSet = new UsersDataSet();
$array = $projectsDataSet->fetchDataByProject($projectID);
$view->MySQL = $array;
//$allMySQL = $MySQL->getTimesheetsgraphs($projectID);
//$view->MySQL = $allMySQL;
require_once('Views/get-project.phtml');