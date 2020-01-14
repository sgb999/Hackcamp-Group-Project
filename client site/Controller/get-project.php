<?php
require_once ('Models/MySQL.php');
$projectID=implode($_GET);
$MySQL = new MySQL();
//$allMySQL = $MySQL->getTimesheetsgraphs($projectID);
//$view->MySQL = $allMySQL;
require_once('Views/get-project.phtml');