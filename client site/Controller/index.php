<?php
require_once ('Models/MySQL.php');
$MySQL = new MySQL();
$ID = $_SESSION['userID'];
$result = $MySQL->getTeamNumbers($ID);

for($i =0 ; $i < count($result); $i++) {
    $allMySQL = $MySQL->getMyProject($result[$i]['teamNumber'], $ID);
    // echo $i . " " . $ID;
    // var_dump($allMySQL);
    // echo var_dump($MySQL->getMyProject($i)->fetchAll());
}
$view->MySQL = $allMySQL;
require_once('Views/index.phtml');