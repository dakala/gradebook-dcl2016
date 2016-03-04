<?php

/**
 * @file
 * Contains \Drupal\gradebook\Form\GradeLetterDeleteForm.
 */

namespace Drupal\gradebook\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;
use Drupal\Core\Url;

/**
 * Builds the grade letter deletion form.
 */
class GradeLetterDeleteForm extends ContentEntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'grade_letter_confirm_delete';
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
//    'entity.grade_letter_set.customize_form'
    return new Url('entity.grade_letter_set.list_form', array(
      'grade_letter_set' => $this->entity->bundle(),
    ));
  }

  /**
   * {@inheritdoc}
   */
  protected function getRedirectUrl() {
    return $this->getCancelUrl();
  }

}
