<?php 
return [
  'column_toggle' => [
    'heading' => 'አምዶች',
  ],
  'columns' => [
    'text' => [
      'actions' => [
        'collapse_list' => 'ያነሰ :count አሳይ',
        'expand_list' => 'ተጨማሪ :count አሳይ',
      ],
      'more_list_items' => 'እና :count ተጨማሪ',
    ],
  ],
  'fields' => [
    'bulk_select_page' => [
      'label' => 'ለጅምላ ድርጊቶች ሁሉንም እቃዎች ይምረጡ/አይምረጡ።',
    ],
    'bulk_select_record' => [
      'label' => 'ለጅምላ ድርጊቶች ንጥል :keyን ይምረጡ/አይምረጡ።',
    ],
    'bulk_select_group' => [
      'label' => 'ለጅምላ ድርጊቶች ቡድን :titleን ይምረጡ/አይምረጡ።',
    ],
    'search' => [
      'label' => 'ፈልግ',
      'placeholder' => 'ፈልግ',
      'indicator' => 'ፈልግ',
    ],
  ],
  'summary' => [
    'heading' => 'ማጠቃለያ',
    'subheadings' => [
      'all' => 'ሁሉም :label',
      'group' => ':group ማጠቃለያ',
      'page' => 'ይህ ገጽ',
    ],
    'summarizers' => [
      'average' => [
        'label' => 'አማካኝ',
      ],
      'count' => [
        'label' => 'መቁጠር',
      ],
      'sum' => [
        'label' => 'ድምር',
      ],
    ],
  ],
  'actions' => [
    'disable_reordering' => [
      'label' => 'መዝገቦችን እንደገና ማዘዝ ጨርስ',
    ],
    'enable_reordering' => [
      'label' => 'መዝገቦችን እንደገና ይዘዙ',
    ],
    'filter' => [
      'label' => 'አጣራ',
    ],
    'group' => [
      'label' => 'ቡድን',
    ],
    'open_bulk_actions' => [
      'label' => 'የጅምላ ድርጊቶች',
    ],
    'toggle_columns' => [
      'label' => 'ዓምዶችን ቀያይር',
    ],
  ],
  'empty' => [
    'heading' => 'ቁጥር :model',
    'description' => 'ለመጀመር :model ይፍጠሩ።',
  ],
  'filters' => [
    'actions' => [
      'apply' => [
        'label' => 'ማጣሪያዎችን ይተግብሩ',
      ],
      'remove' => [
        'label' => 'ማጣሪያን ያስወግዱ',
      ],
      'remove_all' => [
        'label' => 'ሁሉንም ማጣሪያዎች ያስወግዱ',
        'tooltip' => 'ሁሉንም ማጣሪያዎች ያስወግዱ',
      ],
      'reset' => [
        'label' => 'ዳግም አስጀምር',
      ],
    ],
    'heading' => 'ማጣሪያዎች',
    'indicator' => 'ንቁ ማጣሪያዎች',
    'multi_select' => [
      'placeholder' => 'ሁሉም',
    ],
    'select' => [
      'placeholder' => 'ሁሉም',
    ],
    'trashed' => [
      'label' => 'የተሰረዙ መዝገቦች',
      'only_trashed' => 'የተሰረዙ መዝገቦች ብቻ',
      'with_trashed' => 'ከተሰረዙ መዝገቦች ጋር',
      'without_trashed' => 'ያለ የተሰረዙ መዝገቦች',
    ],
  ],
  'grouping' => [
    'fields' => [
      'group' => [
        'label' => 'ቡድን በ',
        'placeholder' => 'ቡድን በ',
      ],
      'direction' => [
        'label' => 'የቡድን አቅጣጫ',
        'options' => [
          'asc' => 'ወደ ላይ መውጣት',
          'desc' => 'መውረድ',
        ],
      ],
    ],
  ],
  'reorder_indicator' => 'መዝገቦቹን ይጎትቱ እና በቅደም ተከተል ያስቀምጡ።',
  'selection_indicator' => [
    'selected_count' => '1 መዝገብ የተመረጡ |:count መዝገቦች ተመርጠዋል',
    'actions' => [
      'select_all' => [
        'label' => 'ሁሉንም :count ይምረጡ',
      ],
      'deselect_all' => [
        'label' => 'ሁሉንም አይምረጡ',
      ],
    ],
  ],
  'sorting' => [
    'fields' => [
      'column' => [
        'label' => 'ደርድር በ',
      ],
      'direction' => [
        'label' => 'አቅጣጫ ደርድር',
        'options' => [
          'asc' => 'ወደ ላይ መውጣት',
          'desc' => 'መውረድ',
        ],
      ],
    ],
  ],
];