<?php

/**
 * @file
 * Contains \Drupal\gradebook\GradeLetterSetAccessControlHandler.
 */

namespace Drupal\gradebook;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the grade letter set entity type.
 *
 * @see \Drupal\gradebook\Entity\GradeLetterSet
 */
class GradeLetterSetAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    switch ($operation) {
      case 'update':
        return AccessResult::allowedIf($account->hasPermission('administer grade letter sets'))->cachePerPermissions()->cacheUntilEntityChanges($entity);

      case 'delete':
        return AccessResult::allowedIf($account->hasPermission('administer grade letter sets') && $entity->id() != 'default')->cachePerPermissions();

      default:
        // No opinion.
        return AccessResult::neutral();
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'administer grade letter sets');
  }

}
