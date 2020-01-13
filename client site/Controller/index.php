<?php
require_once ('Models/MySQL.php');
$MySQL = new MySQL();
$ID = $_SESSION['userID'];
$allMySQL = $MySQL->getMyProject($ID);
$view->MySQL = $allMySQL;
require_once('Views/index.phtml');
//$view = new stdClass();
//$view->pageTitle = 'Topics';
//require_once ('Models/MySQL.php');
//$cat_id=implode($_GET);
//$MySQL = new MySQL();

//$allMySQL = $MySQL->getSelectedTopics($cat_id);
//$view->MySQL = $allMySQL;