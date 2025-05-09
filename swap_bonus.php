<?php

class swap {

  static function sa(&$la, $call = 0) {
    if(count($la)!= 0){
      $tmp = $la[0];
      $la[0] = $la[1];
      $la[1] = $tmp;
      if (!$call)
        return 'sa';
    }
  }

  static function sb(&$lb, $call = 0) {
    if (count($lb) != 0) {
      $tmp = $lb[0];
      $lb[0] = $lb[1];
      $lb[1] = $tmp;
      if(!$call)
        return 'sb';
    }
  }

  static function sc(&$la, &$lb) {
    swap::sa($la, 1);
    swap::sb($lb, 1);

    return 'sc';
  }

}