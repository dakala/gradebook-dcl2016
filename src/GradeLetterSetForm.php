<?php

/**
 * @file
 * Contains \Drupal\gradebook\GradeLetterSetForm.
 */

namespace Drupal\gradebook;

use Drupal\Core\Entity\BundleEntityFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Form controller for the grade letter set entity edit forms.
 */
class GradeLetterSetForm extends BundleEntityFormBase {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $entity = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => t('Set name'),
      '#description' => t('Add a name for this grade letter set.'),
      '#required' => TRUE,
      '#default_value' => $entity->label(),
    );
    $form['id'] = array(
      '#type' => 'machine_name',
      '#machine_name' => array(
        'exists' => '\Drupal\gradebook\Entity\GradeLetterSet::load',
        'source' => array('label'),
        'replace_pattern' => '[^a-z0-9-]+',
        'replace' => '-',
      ),
      '#default_value' => $entity->id(),
      '#maxlength' => EntityTypeInterface::BUNDLE_MAX_LENGTH,
    );

    $form['actions']['submit']['#value'] = t('Create new set');

    return $this->protectBundleIdElement($form);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $is_new = !$entity->getOriginalId();
    $entity->save();

    if ($is_new) {
      drupal_set_message(t('The %set_name grade letter set has been created. You can edit it from this page.', array('%set_name' => $entity->label())));
    }
    else {
      drupal_set_message(t('Updated set name to %set_name.', array('%set_name' => $entity->label())));
    }
    $form_state->setRedirectUrl($this->entity->toUrl('list-form'));
  }

}
