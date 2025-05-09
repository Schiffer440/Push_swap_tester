<?php

class reverse {

  static function ra(&$la, $call = 0) {
    $tmp = array_shift($la);
    array_push($la, $tmp);
    
    if(!$call)
      return 'ra';
  }

  static function rb(&$lb, $call = 0) {
    $tmp = array_shift($lb);
    array_push($lb, $tmp);
    
    if(!$call)
      return 'rb';
  }

  static function rr(&$la, &$lb) {
    reverse::ra($la, 1);
    reverse::rb($lb, 1);

    return 'rr';
  }

  static function rra(&$la, $call = 0) {
    $tmp = array_pop($la);
    array_unshift($la, $tmp);
    
    if(!$call)
      return 'rra';
  }

  static function rrb(&$lb, $call = 0) {
    $tmp = array_pop($lb);
    array_unshift($lb, $tmp);
    
    if(!$call)
      return 'rrb';
    }

  static function rrr(&$la, &$lb) {
    reverse::rra($la, 1);
    reverse::rrb($lb, 1);

    return 'rrr';
  }
}