<?php

require_once 'push_bonus.php';
require_once 'reverse_bonus.php';
require_once 'swap_bonus.php';
require_once 'small_sort_bonus.php';
require_once 'arrays_display.php';
// require_once 'pushswap.php';

function findMedian(&$la)
{
  $tmp = $la;
  sort($tmp);

  $count = count($tmp);
  if ($count % 2 == 0) {
    return $tmp[$count / 2];
  }

  return (($tmp[($count / 2)] + $tmp[($count / 2) - 1]) / 2);
}

function get_lowest(&$la)
{
  $lowest = $la[0];
  $lowest_index = 0;

  for ($i = 0; $i < count($la); $i++) {
    if ($la[$i] < $lowest) {
      $lowest = $la[$i];
      $lowest_index = $i;
    }
  }
  return array('value' => $lowest, 'index' => $lowest_index);
}

function three_in_a(&$la, &$lb)
{
  global $moves;
  $median = findMedian($la);
  $lowest = get_lowest($la);
  // echo $lowest['value'] . PHP_EOL;
  $highest = get_hightest($la);
  // echo $highest . PHP_EOL;

  while (count($la) != 3) {
    // sleep(1);
    if ($la[0] < $median && $la[0] != $lowest['value'] && $la[0] != $highest) {
      $moves .= push::pb($la, $lb) . " ";
    } else if ($la[0] != $lowest['value'] && $la[0] != $highest) {
      $moves .= push::pb($la, $lb) . " ";
      $moves .= reverse::rb($lb) . " ";
    } else {
      if ($la[0] == $lowest['value'] && $la[1] == $highest || $la[0] == $lowest['value'] && $la[1] == $lowest['value']) {
        $moves .= push::pb($la, $lb) . " ";
      }
      $moves .= reverse::ra($la) . " ";
    }
  }
}

function all_identical($la)
{
  for ($i = 0; $i < count($la) - 1; $i++) {
    if ($la[$i] != $la[$i + 1]) {
      return false;
    }
  }
  return true;
}

function big_sort(&$la, &$lb, $mode)
{
  global $moves;
  if ($mode == null) {
    display_array($la, 'la');
    display_array($lb, 'lb');
  }
  three_in_a($la, $lb);
  if ($mode == null) {
    display_array($la, 'la');
    display_array($lb, 'lb');
  }
  small_sort($la, $mode);
  if ($mode == null) {
    display_array($la, 'la');
    display_array($lb, 'lb');
  }
  // echo "ARRAY A : " . PHP_EOL;
  // print_r($la);
  // echo "ARRAY B : " . PHP_EOL;
  // print_r($lb);
  while (count($lb) != 0) {
    // sleep(1);
    if (all_identical($la)) {
      $moves .= push::pa($la, $lb) . " ";
    } else if ($la[0] > $lb[0] || $la[0] == $lb[0]) {
      if ($la[count($la) - 1] > $lb[0]) {
        while ($la[count($la) - 1] > $lb[0]) {
          $moves .= reverse::rra($la) . " ";
        }
      }
      $moves .= push::pa($la, $lb) . " ";
    } else if (($la[0] < $lb[0] && $la[1] > $lb[0]) || ($la[0] < $lb[0] && $la[1] == $lb[0])) {
      $moves .= reverse::ra($la) . " ";
      $moves .= push::pa($la, $lb) . " ";
      $moves .= reverse::rra($la) . " ";
    } else {
      $moves .= reverse::ra($la) . " ";
    }
    // echo "ARRAY A : " . PHP_EOL;
    // print_r($la);
    // echo "ARRAY B : " . PHP_EOL;
    // print_r($lb);
  if ($mode == null) {
    display_array($la, 'la');
    display_array($lb, 'lb');
  }
  }
  $lowest = get_lowest($la);
  if ($lowest['index'] != 0) {
    if ($lowest['index'] < (count($la) / 2)) {
      for ($i = 0; $i < $lowest['index']; $i++) {
        $moves .= reverse::ra($la) . " ";
      }
    } elseif ($lowest['index'] > (count($la) / 2)) {
      for ($i = 0; $i < (count($la) - $lowest['index']); $i++) {
        $moves .= reverse::rra($la) . " ";
      }
    }
  }
  while ($lowest['value'] == $la[count($la) - 1]) {
    $moves .= reverse::rra($la) . " ";
  }
}
