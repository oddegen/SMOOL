<?php 
return [
  'label' => 'የገጽታ አሰሳ',
  'overview' => '{1} 1 ውጤትን በማሳየት ላይ|[2,*] የ :total ውጤቶችን ከ :first እስከ :last በማሳየት ላይ',
  'fields' => [
    'records_per_page' => [
      'label' => 'በገጽ',
      'options' => [
        'all' => 'ሁሉም',
      ],
    ],
  ],
  'actions' => [
    'first' => [
      'label' => 'አንደኛ',
    ],
    'go_to_page' => [
      'label' => 'ወደ ገጽ :page ይሂዱ',
    ],
    'last' => [
      'label' => 'የመጨረሻ',
    ],
    'next' => [
      'label' => 'ቀጥሎ',
    ],
    'previous' => [
      'label' => 'ቀዳሚ',
    ],
  ],
];