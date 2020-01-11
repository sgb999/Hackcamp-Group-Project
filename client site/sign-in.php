<?php
$view = new stdClass();
$view->pageTitle = 'sign-in';
session_start();
if (isset($_SESSION['userID'])){
    require_once ('index.php');
}
else {
    require_once('Controller/sign-in.php');
}