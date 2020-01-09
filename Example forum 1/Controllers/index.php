<?php
require_once ('Models/MySQL.php');
$MySQL = new MySQL();
$allMySQL = $MySQL->getMyProject();
$view->MySQL = $allMySQL;
require_once('Views/index.phtml');