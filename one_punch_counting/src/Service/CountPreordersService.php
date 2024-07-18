<?php

namespace Drupal\one_punch_counting\Service;

use Drupal\one_punch_counting\Traits\onePushTrait;

class CountPreordersService {

  use onePushTrait;

  public function countPreorders() {
    $A0 = [];
    $A1 = [1];
    $A2 = [1, 2];
    $A3 = [1, 2, 3];
    $A4 = [1, 2, 3, 4];

    $results = [
      'A0' => count($this->generateTopologies($A0)),
      'A1' => count($this->generateTopologies($A1)),
      'A2' => count($this->generateTopologies($A2)),
      'A3' => count($this->generateTopologies($A3)),
      'A4' => count($this->generateTopologies($A4)),
    ];

    return $results;
  }

}

