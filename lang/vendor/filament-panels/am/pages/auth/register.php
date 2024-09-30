<?php 
return [
  'title' => 'ይመዝገቡ',
  'heading' => 'ይመዝገቡ',
  'actions' => [
    'login' => [
      'before' => 'ወይም',
      'label' => 'ወደ መለያዎ ይግቡ',
    ],
  ],
  'form' => [
    'email' => [
      'label' => 'የኢሜል አድራሻ',
    ],
    'name' => [
      'label' => 'ስም',
    ],
    'password' => [
      'label' => 'የይለፍ ቃል',
      'validation_attribute' => 'የይለፍ ቃል',
    ],
    'password_confirmation' => [
      'label' => 'የይለፍ ቃል ያረጋግጡ',
    ],
    'actions' => [
      'register' => [
        'label' => 'ይመዝገቡ',
      ],
    ],
  ],
  'notifications' => [
    'throttled' => [
      'title' => 'በጣም ብዙ የምዝገባ ሙከራዎች',
      'body' => 'እባክዎ በ :seconds ሰከንድ ውስጥ እንደገና ይሞክሩ።',
    ],
  ],
];