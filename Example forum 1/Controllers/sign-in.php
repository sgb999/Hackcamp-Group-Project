<?php

if (isset($_POST['submit'])) {

  require 'validation.php';

  if (validate_length($user_name, 3, 20) && validate_length($user_pass, 8, 255)) {
    // Check username and password match in database
    // Log user in
  }

} else {
  header('Location: /');
}
