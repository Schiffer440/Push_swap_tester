<?php

require_once 'push_bonus.php';
require_once 'reverse_bonus.php';
require_once 'swap_bonus.php';
require_once 'arrays_display.php';
// require_once 'small_sort.php';
// require_once 'pushswap.php';

function get_hightest($la)
{
  $highest = $la[0];

  for ($i = 0; $i < count($la); $i++) {
    if ($la[$i] > $highest) {
      $highest = $la[$i];
    }
  }
  return $highest;
}


function small_sort(&$la, $mode)
{
  display_array($la, 'la');
  $highest = get_hightest($la);
  global $moves;
  if ($la[0] == $highest) {
    $moves .= reverse::ra($la) . " ";
    if ($mode == null) {
      display_array($la, 'la');
    }
  } else if ($la[1] == $highest) {
    $moves .= reverse::rra($la) . " ";
    if ($mode == null) {
      display_array($la, 'la');
    }
  }
  if ($la[0] > $la[1]) {
    $moves .= swap::sa($la) . " ";
    if ($mode == null) {
      display_array($la, 'la');
    }
  }
}
