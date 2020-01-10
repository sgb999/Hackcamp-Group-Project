<?php
session_start();
unset($_SESSION['userID']);
unset($_SESSION['username']);
unset($_SESSION['userLevel']);
header("Location: index.php");
exit;