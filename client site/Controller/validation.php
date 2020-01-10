<?php

function validate_length($src, $min, $max) {
  $srclen = strlen($src);
  if ($srclen > $min && $srclen <= $max) {
    return true;
  } else {
    return false;
  }
}

function validate_email($src) {
  return filter_var($src, FILTER_VALIDATE_EMAIL);
}