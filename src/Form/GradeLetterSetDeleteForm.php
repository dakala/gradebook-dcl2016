<?php

/**
 * @file
 * Contains \Drupal\gradebook\Form\GradeLetterSetDeleteForm.
 */

namespace Drupal\gradebook\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;

/**
 *  Builds the grade letter set deletion form.
 */
class GradeLetterSetDeleteForm extends EntityConfirmFormBase {

  /**
   * Gets a confirmation question.
   *
   * @return string
   *   Translated string.
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete Grade letter set: %label?', array(
      '%label' => $this->entity->label(),
    ));
  }

  /**
   * Get the confirmation text.
   *
   * @return string
   *   Translated string.
   */
  public function getConfirmText() {
    return $this->t('Delete grade letter set');
  }

  /**
   * Gets the cancel URL.
   *
   * @return \Drupal\Core\Url
   *   The URL to go to if the user cancels the deletion.
   */
  public function getCancelUrl() {
    return new Url('entity.grade_letter_set.collection');
  }

  /**
   * The submit handler for the confirm form.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();

    drupal_set_message($this->t('Grade letter set:  %label was deleted.', array(
      '%label' => $this->entity->label(),
    )));

    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
