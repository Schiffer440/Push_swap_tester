<?php

require_once 'push_bonus.php';
require_once 'reverse_bonus.php';
require_once 'swap_bonus.php';

function move_tester($list, $moves) {
    $la = explode(" ", $list);
    $array_moves = explode(" ", trim($moves, "\n"));
    $lb = array();
    foreach($array_moves as $move) {
      if ($move == "sa") {
        swap::sa($la);
      } else if ($move == "sb") {
        swap::sb($lb);
      } else if ($move == "ss") {
        swap::sc($la, $lb);
      } else if ($move == "pa") {
        push::pa($la, $lb);
      } else if ($move == "pb") {
        push::pb($la, $lb);
      } else if ($move == "ra") {
        reverse::ra($la);
      } else if ($move == "rb") {
        reverse::rb($lb);
      } else if ($move == "rr") {
        reverse::rr($la, $lb);
      } else if ($move == "rra") {
        reverse::rra($la);
      } else if ($move == "rrb") {
        reverse::rrb($lb);
      } else if ($move == "rrr") {
        reverse::rrr($la, $lb);
      }
    }
    return $la;
}

function rand_number_generator($range) {
  $numbers_string = "";
  for($i = 0; $i < $range; $i++) {
    $numbers_string .= rand(-5000, 5000) . " ";
  }
  return trim($numbers_string);
}

function one_number($file) {
  echo __FUNCTION__ . PHP_EOL;
  for ($i = 1; $i <= 3; $i++) {
    print("Test $i\n");
    $list = rand_number_generator(1);
    $expected_output = shell_exec("php -f " . __DIR__ ."/pushswap_bonus.php -- -m " . $list);
    $output = shell_exec("php -f $file -- " . $list);
    if ($expected_output === $output) {
      print('[OK]' . PHP_EOL);
    }
    else {
      print("[KO]\nList : $list\nExpected output : $expected_output\nYour output : $output");
    }
  } 
}

function small_sorted_list($file) {
  echo __FUNCTION__ . PHP_EOL;
  for ($i = 1; $i <= 5; $i++) {
    print("Test $i\n");
    $list = rand_number_generator(rand(10, 50));
    $array_list = explode(" ", $list);
    sort($array_list);
    $list = implode(" ", $array_list);
    $expected_output = shell_exec("php -f " . __DIR__ . "/pushswap_bonus.php -- -m " . $list);
    $output = shell_exec("php -f $file -- " . $list);
    if ($expected_output === $output) {
      print('[OK]' . PHP_EOL);
    }
    else {
      print("[KO]\nList : $list\nExpected output : $expected_output\nYour output : $output");
    }
  } 
}

function small_unsorted_list($file) {
  echo __FUNCTION__ . PHP_EOL;
  for ($i = 1; $i <= 5; $i++) {
    print("Test $i\n");
    $list = rand_number_generator(rand(10, 50));
    shell_exec("php -f " . __DIR__ . "/pushswap_bonus.php -- -m " . $list);
    $output = shell_exec("php -f $file -- " . $list);
    $tested_list = move_tester($list, $output);
    $json_file = file_get_contents('result.json');
    $data = json_decode($json_file, true);
    $expected_output = $data['Sorted array'];
    // print_r($expected_output);
    // print_r($tested_list);
    if ($expected_output === $tested_list) {
      print('[OK]' . PHP_EOL);
    }
    else {
      print("[KO]\nList : $list\nExpected output : $expected_output\nYour output : $output");
    }
  } 
}

function medium_unsorted_list($file) {
  echo __FUNCTION__ . PHP_EOL;
  for ($i = 1; $i <= 5; $i++) {
    print("Test $i\n");
    $list = rand_number_generator(rand(100, 500));
    shell_exec("php -f " . __DIR__ . "/pushswap_bonus.php -- -m " . $list);
    $output = shell_exec("php -f $file -- " . $list);
    $tested_list = move_tester($list, $output);
    $json_file = file_get_contents('result.json');
    $data = json_decode($json_file, true);
    $expected_output = $data['Sorted array'];
    // echo "________________________________________________________\n";
    // print_r($expected_output);
    // print_r($tested_list);
    if ($expected_output === $tested_list) {
      print('[OK]' . PHP_EOL);
    }
    else {
      print("[KO]\nList : $list\nExpected output : $expected_output\nYour output : $output");
    }
  } 
}

function big_unsorted_list($file) {
  echo __FUNCTION__ . PHP_EOL;
  for ($i = 1; $i <= 5; $i++) {
    print("Test $i\n");
    $list = rand_number_generator(rand(1000, 5000));
    shell_exec("php -f " . __DIR__ . "/pushswap_bonus.php -- -m " . $list);
    $output = shell_exec("php -f $file -- " . $list);
    $tested_list = move_tester($list, $output);
    $json_file = file_get_contents('result.json');
    $data = json_decode($json_file, true);
    $expected_output = $data['Sorted array'];
    // echo "________________________________________________________\n";
    // print_r($expected_output);
    // print_r($tested_list);
    if ($expected_output === $tested_list) {
      print('[OK]' . PHP_EOL);
    }
    else {
      print("[KO]\nList : $list\nExpected output : $expected_output\nYour output : $output");
    }
  } 
}

function run() {
  $required_file = "push_swap.php";

  if (file_exists($required_file)) {
    echo __FUNCTION__ . PHP_EOL;
    one_number($required_file);
    small_sorted_list($required_file);
    small_unsorted_list($required_file);
    medium_unsorted_list($required_file);
    big_unsorted_list($required_file);
  }
  else {
    echo "Wrong or missing file, exptected file: push_swap.php \n";
  }
}

run();
