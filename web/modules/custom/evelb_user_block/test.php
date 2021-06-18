<?php

  $roles = [
    'manager' => 'Manager',
    'developer' => 'Developer'
  ];

  // foreach ($roles as $key => $value) {
  //   $role = \Drupal::entityTypeManager()->getStorage('user_role')->create([
  //     'id'     => $key,
  //     'label'  => $value,
  //   ]);

  //   $role->save();
  // }

  for ($i=1; $i < 10; $i++) {
    $user = \Drupal::entityTypeManager()->getStorage('user')->create([
      'name'      => 'test_' . $i,
      'password'  => 'qwerty',
      'mail'      => 'test' . $i . '@test.com',
      'roles'     => array_rand($roles, 1),
      'isNew'     => TRUE,
      'status'    => TRUE,
    ]);

    $user->save();
  }

