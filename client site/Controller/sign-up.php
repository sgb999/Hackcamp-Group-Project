<?php
require 'validation.php';
    if (isset($_POST['submit'])) {
        if (validate_length($_POST['username'], 3, 20) && validate_length($_POST['pass'], 8, 255) && validate_email($_POST['email'])) {
            if (isset($_POST['submit']))
            {
                require_once('Models/MySQL.php');
                $MySQL = new MySQL(); // creates a MySQL class object
                $result = $MySQL->addUser($_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['pass'], $_POST['email'], $_POST['']); // passes data to the addUser method
                if (!$result) {
                    echo 'something went wrong while registering. Please try again later.';
                }
                else
                {
                    echo 'user successfully added';
                }
            }

    }
        else {
        echo 'You have entered the incorrect information';
    }
}
require_once('../Views/sign-up.phtml');