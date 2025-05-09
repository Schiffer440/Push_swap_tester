<?php

function display_array($la, $name) {
  echo "  $name : \n";
  foreach($la as $val) {
    echo "      $val \n";
  }
  if ($name === 'lb')
  echo "_______________________________________________\n";
  else
  echo "----------------------- \n";
}
