<?php
require 'validation.php';
    if (isset($_POST['submit'])) {
        if (validate_length($_POST['user_name'], 3, 20) && validate_length($_POST['user_pass'], 8, 255) && validate_email($_POST['user_email'])) {
            if (isset($_POST['submit']))
            {
                require_once('Models/MySQL.php');
                $MySQL = new MySQL(); // creates a MySQL class object
                $result = $MySQL->addUser($_POST['username'], $_POST['pass'], $_POST['email']); // passes data to the addUser method
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