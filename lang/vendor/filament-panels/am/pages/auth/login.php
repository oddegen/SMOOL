<?php 
return [
  'title' => 'ግባ',
  'heading' => 'ይግቡ',
  'actions' => [
    'register' => [
      'before' => 'ወይም',
      'label' => 'መለያ ይመዝገቡ',
    ],
    'request_password_reset' => [
      'label' => 'የይለፍ ቃል ረሱ?',
    ],
  ],
  'form' => [
    'email' => [
      'label' => 'የኢሜል አድራሻ',
    ],
    'password' => [
      'label' => 'የይለፍ ቃል',
    ],
    'remember' => [
      'label' => 'አስታውሰኝ',
    ],
    'actions' => [
      'authenticate' => [
        'label' => 'ይግቡ',
      ],
    ],
  ],
  'messages' => [
    'failed' => 'እነዚህ ምስክርነቶች ከኛ መዝገቦች ጋር አይዛመዱም።',
  ],
  'notifications' => [
    'throttled' => [
      'title' => 'በጣም ብዙ የመግባት ሙከራዎች',
      'body' => 'እባክዎ በ :seconds ሰከንድ ውስጥ እንደገና ይሞክሩ።',
    ],
  ],
];