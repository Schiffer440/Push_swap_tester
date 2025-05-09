<?php

class push {

  static function pa(&$la, &$lb) {
    $tmpb = array_shift($lb);
    array_unshift($la, $tmpb);

    return 'pa';
  }

  static function pb(&$la, &$lb) {
    $tmpa = array_shift($la);
    array_unshift($lb, $tmpa);

    return 'pb';
  }
}