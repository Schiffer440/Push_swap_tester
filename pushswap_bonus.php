<?php

require_once 'push_bonus.php';
require_once 'reverse_bonus.php';
require_once 'swap_bonus.php';
require_once 'small_sort_bonus.php';
require_once 'big_sort_bonus.php';
require_once 'arrays_display.php';
$moves = "";

function check_lists($la)
{
  for ($i = 0; $i < count($la) - 1; $i++) {
    if ($la[$i] > $la[$i + 1])
      return false;
  }
  return true;
}

function pushswap($la, $mode = null)
{
  global $moves;
  $original_array = $la;
  $lb = array();
  if (check_lists($la)  == true)
    print("\n");
  else if (count($la) == 2 && $la[0] > $la[1]) {
    $moves .= swap::sa($la, 0) . " ";
  } else if (count($la) == 3) {
    small_sort($la, $mode);
  } else {
    big_sort($la, $lb, $mode);
  }
  $result_array = array(
    'Original array' => $original_array,
    'Sorted array' => $la,
    'Sort status' => array(check_lists($la)),
    'Moves' => explode(' ', $moves),
    'Moves number' => count(explode(' ', $moves))
  );
  $json = json_encode($result_array, JSON_PRETTY_PRINT);
  file_put_contents('result.json', $json);
}

function validate_number_list($list)
{
  for ($i = 0; $i < count($list); $i++) {
    if (is_numeric($list[$i]) != true) {
      return false;
    }
  }
  return true;
}


function main($argc, $argv)
{
  if ($argc != 1) {
    $tab = array();
    if ($argv[1] == '-m') {
      $begin = 2;
    } else {
      $begin = 1;
    }
    for ($i = $begin; $i < count($argv); $i++) {
      array_push($tab, $argv[$i]);
    }
    if (validate_number_list($tab) == true) {
      if ($begin == 2) {
        pushswap($tab, 'mouli');
      } else {
        pushswap($tab);
      }
    } else {
      return print("Please enter valid numbers \n");
    }
  } else
    return print("Please enter your number list \n");
}

main($argc, $argv);
