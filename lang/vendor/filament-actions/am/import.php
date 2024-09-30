<?php 
return [
  'label' => 'አስመጣ :label',
  'modal' => [
    'heading' => 'አስመጣ :label',
    'form' => [
      'file' => [
        'label' => 'ፋይል',
        'placeholder' => 'የCSV ፋይል ይስቀሉ።',
        'rules' => [
          'duplicate_columns' => '{0} ፋይሉ ከአንድ በላይ ባዶ የአምድ ራስጌ መያዝ የለበትም።|{1,*} ፋይሉ የተባዙ የአምድ ራስጌዎችን መያዝ የለበትም፡ :columns።',
        ],
      ],
      'columns' => [
        'label' => 'አምዶች',
        'placeholder' => 'አንድ አምድ ይምረጡ',
      ],
    ],
    'actions' => [
      'download_example' => [
        'label' => 'ለምሳሌ የCSV ፋይል ያውርዱ',
      ],
      'import' => [
        'label' => 'አስመጣ',
      ],
    ],
  ],
  'notifications' => [
    'completed' => [
      'title' => 'ማስመጣት ተጠናቅቋል',
      'actions' => [
        'download_failed_rows_csv' => [
          'label' => 'ስለ ያልተሳካው ረድፍ መረጃ ያውርዱ|ስለ ያልተሳኩ ረድፎች መረጃ ያውርዱ',
        ],
      ],
    ],
    'max_rows' => [
      'title' => 'የተጫነው የCSV ፋይል በጣም ትልቅ ነው።',
      'body' => 'በአንድ ጊዜ ከ1 ረድፍ በላይ ማስመጣት አይችሉም።|በአንድ ጊዜ ከ :count ረድፎች በላይ ማስመጣት አይችሉም።',
    ],
    'started' => [
      'title' => 'ማስመጣት ተጀመረ',
      'body' => 'ማስመጣት ጀምሯል እና 1 ረድፍ ከበስተጀርባ ይከናወናል።|የእርስዎ ማስመጣት ጀምሯል እና :count ረድፎች ከበስተጀርባ ይሰራሉ።',
    ],
  ],
  'example_csv' => [
    'file_name' => ':importer - ምሳሌ',
  ],
  'failure_csv' => [
    'file_name' => 'አስመጣ -: import_id -: csv_name-failed-rows',
    'error_header' => 'ስህተት',
    'system_error' => 'የስርዓት ስህተት፣ እባክዎ ድጋፍን ያግኙ።',
    'column_mapping_required_for_new_record' => 'የ :attribute አምድ በፋይሉ ውስጥ ባለ አምድ ላይ አልተቀረፀም ነገር ግን አዲስ መዝገቦችን ለመፍጠር ያስፈልጋል።',
  ],
];