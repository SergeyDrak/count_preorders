<?php

namespace Drupal\one_punch_counting\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\one_punch_counting\Service\CountPreordersService;

class onePushCountingForm extends FormBase {

  protected $countPreordersService;

  public function __construct(CountPreordersService $countPreordersService) {
    $this->countPreordersService = $countPreordersService;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('drupal.one_punch_counting.count_preorders_service')
    );
  }

  public function getFormId() {
    return 'ajax_one_push_counting_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('This form counts preorders for predefined sets A0 to A4'),
    ];
    $form['test_selection'] = [
      '#type' => 'radios',
      '#title' => $this->t('Replaced options'),
      '#options' => [
        '0' => $this->t('[]'),
        '1' => $this->t('[1]'),
        '2' => $this->t('[1, 2]'),
        '3' => $this->t('[1, 2, 3]'),
        '4' => $this->t('[1, 2, 3, 4]'),
      ],
      '#ajax' => [
        'wrapper' => 'questions-fieldset-wrapper',
        'callback' => '::promptCallback',
        'effect' => 'fade',
      ],
    ];
    $form['questions_fieldset'] = [
      '#type' => 'details',
      '#title' => $this->t('Result will appear here'),
      '#open' => TRUE,
      '#attributes' => [
        'id' => 'questions-fieldset-wrapper',
        'class' => ['questions-wrapper'],
      ],
    ];

    return $form;
  }

  public function promptCallback(array $form, FormStateInterface $form_state) {
    $results = $this->countPreordersService->countPreorders();
    $selected = $form_state->getValue('test_selection');
    $result_string = "A$selected: " . $results["A$selected"];

    $response = new AjaxResponse();
    $response->addCommand(new ReplaceCommand('#questions-fieldset-wrapper', '<div id="questions-fieldset-wrapper">' . $result_string . '</div>'));
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {}

}
