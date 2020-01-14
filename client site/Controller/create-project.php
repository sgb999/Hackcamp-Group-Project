<?php
require_once ('Models/MySQL.php');
$projectID=implode($_GET);
$MySQL = new MySQL();
//$allMySQL = $MySQL->getSelectedTopics($projectID);
//$view->MySQL = $allMySQL;
    //$view->MySQL = $MySQL->getCat();
   // if (isset($_POST['submit'])) {
      //  $result = $MySQL->setTopics($_POST['topic_subject'], $_POST['cat_id']);
        //$result = $MySQL->setPosts($_POST['post_content'], $_POST['topic_subject']);
      //  header("Refresh:0");
   // }
    require_once('Views/create-project.phtml');