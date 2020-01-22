<?php
session_start();
$view = new stdClass();
if ($_SESSION['userLevel'] == 1) //checks if user is admin
{
    $view->pageTitle = 'Register a user';
    require_once('Controller/sign-up.php');
}
else{
    header('Location: index.php');
}