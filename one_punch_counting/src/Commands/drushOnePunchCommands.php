<?php

namespace Drupal\one_punch_counting\Commands;

use Drupal\one_punch_counting\Traits\onePushTrait;
use Drush\Commands\DrushCommands;

class drushOnePunchCommands extends DrushCommands {

  use onePushTrait;

  /**
   * Count preorders for predefined sets A0 to A4.
   *
   * @command one_punch_counting:count-preorders
   * @aliases opp
   */
  public function countPreorders() {
    $A0 = [];
    $A1 = [1];
    $A2 = [1, 2];
    $A3 = [1, 2, 3];
    $A4 = [1, 2, 3, 4];

    $results = [
      'A0' => count($this->generateTopologies($A0)) . ' - [' . implode(',', $A0) . ']',
      'A1' => count($this->generateTopologies($A1)) . ' - [' . implode(',', $A1) . ']',
      'A2' => count($this->generateTopologies($A2)) . ' - [' . implode(',', $A2) . ']',
      'A3' => count($this->generateTopologies($A3)) . ' - [' . implode(',', $A3) . ']',
      'A4' => count($this->generateTopologies($A4)) . ' - [' . implode(',', $A4) . ']',
    ];

    foreach ($results as $key => $count) {
      $this->output()->writeln("<question>$key: $count'</question>");
    }
  }

}
