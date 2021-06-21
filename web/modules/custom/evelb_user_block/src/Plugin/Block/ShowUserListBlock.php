<?php

namespace Drupal\evelb_user_block\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\evelb_user_block\UsersList;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "users_list",
 *   admin_label = @Translation("users_list"),
 * )
 */

class ShowUserListBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $users = UsersList::getAllUsersData();
    $current_user_id = \Drupal::currentUser()->id();
    foreach ($users as $key => $user) {
      $user['current_user'] = FALSE;
      if ($user['id'] == $current_user_id) {
        $users[$key]['current_user'] = TRUE;
      }
    }
    return [
      '#theme'      => 'evelb_user_block__users_list',
      '#users_list' => $users,
    ];
  }

  /**
   * {@inheritdoc}
  */
  protected function blockAccess(AccountInterface $account) {
    $roles = ['administrator', 'manager'];
    $has_role = array_intersect($roles, $account->getRoles(TRUE));
    if (!empty($has_role)) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

}