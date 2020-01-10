<?php
$view = new stdClass();
$view->pageTitle = 'Register a user';
session_start();
require_once('Controller/sign-up.php');