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
  'ADMIN_PASSWORD' => env('ADMIN_PASSWORD'),
  'OWNER_PASSWORD' => env('OWNER_PASSWORD'),
  'USER_PASSWORD' => env('USER_PASSWORD'),
];
