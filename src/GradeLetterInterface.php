<?php

/**
 * @file
 * Contains \Drupal\gradebook\GradeLetterInterface.
 */

namespace Drupal\gradebook;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a grade letter entity.
 */
interface GradeLetterInterface extends ContentEntityInterface {

  /**
   * Returns the title of this grade_letter.
   *
   * @return string
   *   The title of this grade_letter.
   */
  public function getTitle();

  /**
   * Sets the title of this grade_letter.
   *
   * @param string $title
   *   The title of this grade letter.
   *
   * @return \Drupal\gradebook\GradeLetterInterface
   *   The called grade letter entity.
   */
  public function setTitle($title);

  /**
   * Returns the weight among grade letters with the same depth.
   *
   * @return int
   *   The grade letter weight.
   */
  public function getWeight();

  /**
   * Sets the weight among grade letters with the same depth.
   *
   * @param int $weight
   *   The grade letter weight.
   *
   * @return \Drupal\gradebook\GradeLetterInterface
   *   The called grade letter entity.
   */
  public function setWeight($weight);

  /**
   * Returns the description of the grade letter.
   *
   * @return string
   *   The grade letter description.
   */
  public function getDescription();

  /**
   * Sets the description of the grade letter.
   *
   * @param string $description
   *   The grade letter description.
   *
   * @return \Drupal\gradebook\GradeLetterInterface
   *   The called grade letter entity.
   */
  public function setDescription($description);

  /**
   * Returns the highest among grade letters with the same depth.
   *
   * @return int
   *   The grade letter highest.
   */
  public function getHighest();

  /**
   * Sets the highest among grade letters with the same depth.
   *
   * @param int $highest
   *   The highest grade letter.
   *
   * @return \Drupal\gradebook\GradeLetterInterface
   *   The called grade letter entity.
   */
  public function setHighest($highest);

  /**
   * Returns the lowest among grade letters with the same depth.
   *
   * @return int
   *   The lowest grade letter.
   */
  public function getLowest();

  /**
   * Sets the lowest among grade letters with the same depth.
   *
   * @param int $lowest
   *   The lowest grade letter.
   *
   * @return \Drupal\gradebook\GradeLetterInterface
   *   The called grade letter entity.
   */
  public function setLowest($lowest);
}
