<?php
return [
  'STATUS_CODE' => [
    'OK' => 200,
    'NO_CONTENT' => 204,
    'BAD_REQUEST' => 400,
  ],
  'ROLE' => [
    'USER' => 'user',
    'OWNER' => 'owner',
    'ADMIN' => 'admin',
    'GUEST' => 'guest'
  ],
  'LOGIN_URL' => env('LOGIN_URL'),
  'PASSWORD' => [
    'USER' => env('USER_PASSWORD'),
    'OWNER' => env('OWNER_PASSWORD'),
    'ADMIN' => env('ADMIN_PASSWORD'),
  ],
  'GUEST_EMAIL' => [
    'USER' => 'guest@user.com',
    'OWNER' => 'guest@owner.com',
    'ADMIN' => 'guest@admin.com',
  ],
  'DEFAULT_IMAGE_URL' => env('DEFAULT_IMAGE_URL'),
];
