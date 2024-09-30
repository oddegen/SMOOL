<?php 
return [
  'label' => ' :label ላክ',
  'modal' => [
    'heading' => ' :label ላክ',
    'form' => [
      'columns' => [
        'label' => 'አምዶች',
        'form' => [
          'is_enabled' => [
            'label' => ':column ነቅቷል።',
          ],
          'label' => [
            'label' => ':column መለያ',
          ],
        ],
      ],
    ],
    'actions' => [
      'export' => [
        'label' => 'ወደ ውጪ ላክ',
      ],
    ],
  ],
  'notifications' => [
    'completed' => [
      'title' => 'ወደ ውጭ መላክ ተጠናቅቋል',
      'actions' => [
        'download_csv' => [
          'label' => 'አውርድ .csv',
        ],
        'download_xlsx' => [
          'label' => '.xlsx አውርድ',
        ],
      ],
    ],
    'max_rows' => [
      'title' => 'ወደ ውጭ መላክ በጣም ትልቅ ነው።',
      'body' => 'በአንድ ጊዜ ከአንድ ረድፍ በላይ ወደ ውጭ መላክ አይችሉም።|በአንድ ጊዜ ከ :count ረድፎች በላይ ወደ ውጭ መላክ አይችሉም።',
    ],
    'started' => [
      'title' => 'መላክ ተጀመረ',
      'body' => 'ወደ ውጭ መላክዎ ተጀምሯል እና 1 ረድፍ ከበስተጀርባ ይካሄዳል። የማውረጃው ሊንክ ሲጠናቀቅ ማሳወቂያ ይደርስዎታል።|የእርስዎ መላክ ተጀምሯል እና :count ረድፎች ከበስተጀርባ ይሰራሉ። ሲጠናቀቅ ከአውርድ ማገናኛ ጋር ማሳወቂያ ይደርስዎታል።',
    ],
  ],
  'file_name' => 'ወደ ውጪ መላክ -: ኤክስፖርት_id - ሞዴል',
];