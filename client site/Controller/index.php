<?php
require_once ('Models/MySQL.php');
$MySQL = new MySQL();
$ID = $_SESSION['userID'];
$result = $MySQL->getTeamNumbers($ID);

$allMySQL = [];

for($i =0 ; $i < count($result); $i++) {
    array_push($allMySQL, $MySQL->getMyProject($result[$i]['teamNumber'], $ID));
    // var_dump($allMySQL);
}
$view->MySQL = $allMySQL;
require_once('Views/index.phtml');