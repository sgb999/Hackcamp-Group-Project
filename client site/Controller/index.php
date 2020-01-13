<?php
require_once ('Models/MySQL.php');
$MySQL = new MySQL();
$ID = $_SESSION['userID'];
$result = $MySQL->getTeamNumber($ID);
$teamNumbers = $result['teamNumber'];
for($i =0 ; $i < $result; $i++) {
    $allMySQL = $MySQL->getMyProject($teamNumbers[$i]);
}
$view->MySQL = $allMySQL;
require_once('Views/index.phtml');