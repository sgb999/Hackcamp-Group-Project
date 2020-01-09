<?php

if (isset($_POST['submit'])) {

  require 'validation.php';

  if (validate_length($user_name, 3, 20) && validate_length($user_pass, 8, 255) && validate_email($user_email)) {
    // Insert user into database
    // Log user in
  } else {
    // Report error
  }

} else {
  header('Location: /');
}