<?php
require_once ('Models/MySQL.php');
if (isset($_POST['submit'])) {
  require 'validation.php';
  if (validate_length($_POST['username'], 3, 20) && validate_length($_POST['pass'], 7, 255)) {
      $userDataSet = new MySQL();
      $logUserIn = $userDataSet->login($_POST['username'],$_POST['pass']);
      if(!$logUserIn)
      {
          echo "Incorrect Username or Password";
      }
      else
      {
          $_SESSION['userID'] = $logUserIn['userID'];
          $_SESSION['username'] = $logUserIn['username'];
          $_SESSION['userLevel'] = $logUserIn['userLevel'];
          echo $_SESSION['userID'];
          echo $_SESSION['username'];
          echo $_SESSION['userLevel'];
          echo 'works';
          header("Location: /index.php");
      }
  }
}
require_once('Views/sign-in.phtml');
