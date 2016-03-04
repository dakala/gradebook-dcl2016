<?php

/**
 * @file
 * Contains \Drupal\gradebook\Entity\grade_letter.
 */

namespace Drupal\gradebook\Entity;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\gradebook\GradeLetterInterface;

/**
 * Defines the grade letter entity class.
 *
 * @ContentEntityType(
 *   id = "grade_letter",
 *   label = @Translation("Grade letter"),
 *   handlers = {
 *     "access" = "Drupal\gradebook\GradeLetterAccessControlHandler",
 *     "form" = {
 *       "default" = "Drupal\gradebook\GradeLetterForm",
 *       "add" = "Drupal\gradebook\GradeLetterForm",
 *       "edit" = "Drupal\gradebook\GradeLetterForm",
 *       "delete" = "Drupal\gradebook\Form\GradeLetterDeleteForm"
 *     },
 *     "translation" = "Drupal\content_translation\ContentTranslationHandler"
 *   },
 *   base_table = "grade_letter",
 *   data_table = "grade_letter_field_data",
 *   translatable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "bundle" = "grade_letter_set",
 *     "label" = "title",
 *     "langcode" = "langcode",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/gradebook/grade_letter/{grade_letter}",
 *     "delete-form" = "/admin/config/gradebook/grade_letter/{grade_letter}/delete",
 *     "edit-form" = "/admin/config/gradebook/grade_letter/{grade_letter}/edit",
 *   },
 *   bundle_entity_type = "grade_letter_set"
 * )
 */
class GradeLetter extends ContentEntityBase implements GradeLetterInterface {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($link_title) {
    $this->set('title', $link_title);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->set('description', $description);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->get('description')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getGradeLetterSet() {
    return $this->get('grade_letter_set')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setGradeLetterSet($grade_letter_set) {
    return $this->set('grade_letter_set', $grade_letter_set);
  }

  /**
   * {@inheritdoc}
   */
  public function getWeight() {
    return $this->get('weight')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setWeight($weight) {
    $this->set('weight', $weight);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLowest() {
    return $this->get('lowest')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setLowest($lowest) {
    $this->set('lowest', $lowest);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getHighest() {
    return $this->get('highest')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setHighest($highest) {
    $this->set('highest', $highest);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the grade letter.'))
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the grade letter.'))
      ->setReadOnly(TRUE);

    $fields['grade_letter_set'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('GradeLetter set'))
      ->setDescription(t('The bundle of the grade letter.'))
      ->setSetting('target_type', 'grade_letter_set')
      ->setRequired(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The grade letter or short name.'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -10,
        'settings' => array(
          'size' => 60,
        ),
      ));

    $fields['description'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Description'))
      ->setDescription(t('A description of the grade letter or long name.'))
      ->setTranslatable(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'weight' => -9,
      ))
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -9,
        'settings' => array(
          'size' => 60,
        ),
      ));

    $fields['lowest'] = BaseFieldDefinition::create('float')
      ->setLabel(t('Lowest'))
      ->setDescription(t('The lowest mark (%age) for this grade letter.'))
      ->setSetting('unsigned', TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'weight' => -8,
        'scale' => 2,
      ))
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -8,
        'settings' => array(
          'size' => 10,
        ),
      ));

    $fields['highest'] = BaseFieldDefinition::create('float')
      ->setLabel(t('Highest'))
      ->setDescription(t('The highest mark (%age) for this grade letter.'))
      ->setSetting('unsigned', TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'weight' => -7,
        'scale' => 2,
      ))
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -7,
        'settings' => array(
          'size' => 10,
        ),
      ));

    $fields['weight'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Weight'))
      ->setDescription(t('Weight among grade letters in the same grade letter set.'));


    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language'))
      ->setDescription(t('The language code of the grade_letter.'))
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'type' => 'hidden',
      ))
      ->setDisplayOptions('form', array(
        'type' => 'language_select',
        'weight' => 2,
      ));

    return $fields;
  }

  /**
   * Sort grade letter objects.
   *
   * Callback for uasort().
   *
   * @param \Drupal\gradebook\GradeLetterInterface $a
   *   First grade letter for comparison.
   * @param \Drupal\gradebook\GradeLetterInterface $b
   *   Second grade letter for comparison.
   *
   * @return int
   *   The comparison result for uasort().
   */
  public static function sort(GradeLetterInterface $a, GradeLetterInterface $b) {
    $a_weight = $a->getWeight();
    $b_weight = $b->getWeight();
    if ($a_weight == $b_weight) {
      return strnatcasecmp($a->getTitle(), $b->getTitle());
    }
    return ($a_weight < $b_weight) ? -1 : 1;
  }

}
