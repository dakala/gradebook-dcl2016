<?php

/**
 * @file
 * Contains \Drupal\gradebook\Entity\GradeLetterSet.
 */

namespace Drupal\gradebook\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\gradebook\GradeLetterSetInterface;

/**
 * Defines the GradeLetter set configuration entity.
 *
 * @ConfigEntityType(
 *   id = "grade_letter_set",
 *   label = @Translation("Grade letter set"),
 *   handlers = {
 *     "access" = "Drupal\gradebook\GradeLetterSetAccessControlHandler",
 *     "list_builder" = "Drupal\gradebook\GradeLetterSetListBuilder",
 *     "form" = {
 *       "default" = "Drupal\gradebook\GradeLetterSetForm",
 *       "add" = "Drupal\gradebook\GradeLetterSetForm",
 *       "edit" = "Drupal\gradebook\GradeLetterSetForm",
 *       "list" = "Drupal\gradebook\Form\GradeLetterSetListForm",
 *       "delete" = "Drupal\gradebook\Form\GradeLetterSetDeleteForm"
 *     }
 *   },
 *   config_prefix = "set",
 *   bundle_of = "grade_letter",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   links = {
 *     "list-form" = "/admin/config/gradebook/grade_letter/manage/{grade_letter_set}/list",
 *     "delete-form" = "/admin/config/gradebook/grade_letter/manage/{grade_letter_set}/delete",
 *     "edit-form" = "/admin/config/gradebook/grade_letter/manage/{grade_letter_set}/edit",
 *     "canonical" = "/admin/config/gradebook/grade_letter_set",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *   }
 * )
 */
class GradeLetterSet extends ConfigEntityBundleBase implements GradeLetterSetInterface {

  /**
   * The machine name for the configuration entity.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the configuration entity.
   *
   * @var string
   */
  protected $label;

  /**
   * {@inheritdoc}
   */
  public function getGradeLetters() {
    $grade_letters = \Drupal::entityManager()->getStorage('grade_letter')->loadByProperties(array('grade_letter_set' => $this->id()));
    uasort($grade_letters, array('\Drupal\gradebook\Entity\GradeLetter', 'sort'));
    return $grade_letters;
  }

  /**
   * @inheritdoc
   */
  public function getTotalGradeLetters() {
    return count($this->getGradeLetters());
  }

}
