<?php
require_once ('Models/ProjectsDataSet.php');
require_once ('Models/Projects.php');
$projectsDataSet = new ProjectsDataSet();
$ID = $_SESSION['userID'];
$dataset = $projectsDataSet->fetchDataByUserID($ID);
$view->MySQL = $dataset;
require_once('Views/index.phtml');