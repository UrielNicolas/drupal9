<?php

namespace Drupal\evelb_user_block;

use Drupal\user\Entity\User;

/**
 * Class Utils.
 *
 */
class UsersList {
  /**
   * Get all users
   */
  public static function getAllUsersData() {
    $users_id_list = \Drupal::entityQuery('user')
      ->execute();
    $storage_handler = \Drupal::entityTypeManager()->getStorage("user");
    $users_id = array_values($users_id_list);
    $user_list = [];
    foreach ($users_id as $key => $user_id) {
      $user = $storage_handler->load($user_id);
      $user_list[$key]['id'] = $user->uid->value;
      $user_list[$key]['name'] = $user->name->value;
      $user_list[$key]['mail'] = $user->mail->value;
    }

    return $user_list;
  }
}