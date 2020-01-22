<?php
require_once('Models/ProjectsDataSet.php');
$projectsDataSet = new projectsDataSet();
$view->projectsDataSet = $projectsDataSet->fetchAll();
require_once('Views/view-all-projects.phtml');