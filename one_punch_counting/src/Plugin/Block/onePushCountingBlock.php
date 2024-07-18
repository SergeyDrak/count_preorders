<?php

namespace Drupal\one_punch_counting\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Example: uppercase this please' block.
 *
 * @Block(
 *   id = "one_push_block",
 *   admin_label = @Translation("Counting one push block")
 * )
 */
class onePushCountingBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()
      ->getForm('\Drupal\one_punch_counting\Form\onePushCountingForm');
    return $form;
  }

}


