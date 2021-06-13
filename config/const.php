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
    'ADMIN' => 'admin'
  ],
  'LOGIN_URL' => env('LOGIN_URL'),
];
