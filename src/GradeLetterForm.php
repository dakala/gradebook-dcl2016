<?php

/**
 * @file
 * Contains \Drupal\gradebook\GradeLetterForm.
 */

namespace Drupal\gradebook;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the grade letter forms.
 */
class GradeLetterForm extends ContentEntityForm {

  /**
   * The entity being used by this form.
   *
   * @var \Drupal\gradebook\GradeLetterInterface
   */
  protected $entity;

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = $entity->save();

    if ($status == SAVED_UPDATED) {
      $message = $this->t('The grade letter %grade_letter has been updated.', array('%grade_letter' => $entity->getTitle()));
    }
    else {
      $message = $this->t('Added a grade letter for %title.', array('%title' => $entity->getTitle()));
    }
    drupal_set_message($message);

    $form_state->setRedirect(
      'entity.grade_letter_set.list_form',
      array('grade_letter_set' => $entity->bundle())
    );
  }

}
