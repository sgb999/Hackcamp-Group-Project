<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'Topics';
require_once('Controller/get-project.php');