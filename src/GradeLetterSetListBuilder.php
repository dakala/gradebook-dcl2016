<?php

/**
 * @file
 * Contains \Drupal\gradebook\GradeLetterSetListBuilder.
 */

namespace Drupal\gradebook;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Defines a class to build a listing of grade letter set entities.
 *
 * @see \Drupal\gradebook\Entity\GradeLetterSet
 */
class GradeLetterSetListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = t('Name');
    $header['total_letters'] = t('Total letters');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOperations(EntityInterface $entity) {
    $operations = parent::getDefaultOperations($entity);

    if (isset($operations['edit'])) {
      $operations['edit']['title'] = t('Edit grade letter set');
    }

    $operations['list'] = array(
      'title' => t('List grade letters'),
      'url' => $entity->toUrl('list-form'),
    );

    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['name'] = $entity->label();
    $row['total_letters']['data'] = $entity->getTotalGradeLetters();
    return $row + parent::buildRow($entity);
  }

}
