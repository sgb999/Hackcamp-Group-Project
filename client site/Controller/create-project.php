<?php
require_once ('Models/MySQL.php');
$projectID=implode($_GET);
$MySQL = new MySQL();

//$view->MySQL = $allMySQL;
   if (isset($_POST['submit'])) {
       $result = $MySQL->checkClient($_POST['clientName']);
       if(!$result)
       {
           $result = $MySQL->createClient($_POST['clientName']);
       }
       $result = $MySQL->getClientID($_POST['clientName']);
       $number = $MySQL->getTeamNumbers();
       do{
           $num = (rand(1, 99999999999));
           $match = false;
           foreach ($number as $dbnum){
               if ($num == $dbnum){
                   $match = true;
               }
               //array_push($allMySQL )
           }
       }while($match == true);
       $array = explode(', ', $_POST['usernames']);
       $arrayIDs =[];
       foreach ($array as $username){
           $arrayIDs = $MySQL->getUserID($username);
       }
       foreach ($arrayIDs as $user) {
           $something = $MySQL->createTeam($user, $num);
       }
       $somethingElse = $MySQL->createProject($_POST['projectName'], $result, $num);
    }
    require_once('Views/create-project.phtml');