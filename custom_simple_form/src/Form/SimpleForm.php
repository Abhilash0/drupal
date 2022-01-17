<?php

namespace Drupal\custom_simple_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Our simple form class.
 */

class SimpleForm extends ConfigFormBase {
  
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_simple_form.settings'
    ];
  }
  /**
   * {@inheritdoc}
   * 
   */

  public function getFormId() {
    return 'simple_form';
    
  }

  /**
   * {@inheritdoc}
   */

  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_simple_form.settings');
    $form['passenger_payable_amount'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Passenger Payable Amount'),
      '#default_value' => $config->get('passenger_payable_amount'),
    ];
    $form['driver_payable_amount_rupees'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Driver Payable Amount Rupees'),
      '#default_value' => $config->get('driver_payable_amount_rupees'),
    ];
    return parent::buildForm($form, $form_state);
  
  }
   /**
   * {@inheritdoc}
   * 
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  parent::submitForm($form, $form_state);
    $this->config('custom_simple_form.settings')
    ->set('passenger_payable_amount', $form_state->getValue('passenger_payable_amount'))
    ->set('driver_payable_amount_rupees', $form_state->getValue('driver_payable_amount_rupees'))
    ->save();
   
 }
}