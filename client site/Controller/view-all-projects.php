<?php
require_once('Models/ProjectsDataSet.php');
$MySQL = new projectsDataSet();
$allMySQL = $MySQL->fetchAll();
$view->MySQL = $allMySQL;
require_once('Views/view-all-projects.phtml');