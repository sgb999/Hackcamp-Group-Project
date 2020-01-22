<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'sign-in';
require_once('Controller/sign-in.php');