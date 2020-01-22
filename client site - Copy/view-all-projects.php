<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'All Projects';
require_once('Controller/view-all-projects.php');