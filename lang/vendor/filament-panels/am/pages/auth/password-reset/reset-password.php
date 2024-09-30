<?php 
return [
  'title' => 'የይለፍ ቃልዎን ዳግም ያስጀምሩ',
  'heading' => 'የይለፍ ቃልዎን ዳግም ያስጀምሩ',
  'form' => [
    'email' => [
      'label' => 'የኢሜል አድራሻ',
    ],
    'password' => [
      'label' => 'የይለፍ ቃል',
      'validation_attribute' => 'የይለፍ ቃል',
    ],
    'password_confirmation' => [
      'label' => 'የይለፍ ቃል ያረጋግጡ',
    ],
    'actions' => [
      'reset' => [
        'label' => 'የይለፍ ቃል ዳግም አስጀምር',
      ],
    ],
  ],
  'notifications' => [
    'throttled' => [
      'title' => 'በጣም ብዙ ዳግም የማስጀመር ሙከራዎች',
      'body' => 'እባክዎ በ :seconds ሰከንድ ውስጥ እንደገና ይሞክሩ።',
    ],
  ],
];