<?php
session_start();
$view = new stdClass();
if(isset($_SESSION['username'])) {
    $view->pageTitle = 'Homepage';
    require_once ('Controller/index.php');
}
else{
    header('Location: sign-in.php');
}