<?php 
return [
  'builder' => [
    'actions' => [
      'clone' => [
        'label' => 'ክሎን።',
      ],
      'add' => [
        'label' => 'ወደ :label ያክሉ',
        'modal' => [
          'heading' => 'ወደ :label ያክሉ',
          'actions' => [
            'add' => [
              'label' => 'አክል',
            ],
          ],
        ],
      ],
      'add_between' => [
        'label' => 'በብሎኮች መካከል አስገባ',
        'modal' => [
          'heading' => 'ወደ :label ያክሉ',
          'actions' => [
            'add' => [
              'label' => 'አክል',
            ],
          ],
        ],
      ],
      'delete' => [
        'label' => 'ሰርዝ',
      ],
      'edit' => [
        'label' => 'አርትዕ',
        'modal' => [
          'heading' => 'እገዳን ያርትዑ',
          'actions' => [
            'save' => [
              'label' => 'ለውጦችን ያስቀምጡ',
            ],
          ],
        ],
      ],
      'reorder' => [
        'label' => 'አንቀሳቅስ',
      ],
      'move_down' => [
        'label' => 'ወደ ታች ውሰድ',
      ],
      'move_up' => [
        'label' => 'ወደ ላይ ተንቀሳቀስ',
      ],
      'collapse' => [
        'label' => 'ሰብስብ',
      ],
      'expand' => [
        'label' => 'ዘርጋ',
      ],
      'collapse_all' => [
        'label' => 'ሁሉንም ሰብስብ',
      ],
      'expand_all' => [
        'label' => 'ሁሉንም ዘርጋ',
      ],
    ],
  ],
  'checkbox_list' => [
    'actions' => [
      'deselect_all' => [
        'label' => 'ሁሉንም አይምረጡ',
      ],
      'select_all' => [
        'label' => 'ሁሉንም ይምረጡ',
      ],
    ],
  ],
  'file_upload' => [
    'editor' => [
      'actions' => [
        'cancel' => [
          'label' => 'ሰርዝ',
        ],
        'drag_crop' => [
          'label' => 'የመጎተት ሁነታ "ሰብል"',
        ],
        'drag_move' => [
          'label' => 'የመጎተት ሁነታ "አንቀሳቅስ"',
        ],
        'flip_horizontal' => [
          'label' => 'ምስሉን በአግድም ገልብጥ',
        ],
        'flip_vertical' => [
          'label' => 'ምስሉን በአቀባዊ ገልብጥ',
        ],
        'move_down' => [
          'label' => 'ምስል ወደ ታች ውሰድ',
        ],
        'move_left' => [
          'label' => 'ምስል ወደ ግራ ውሰድ',
        ],
        'move_right' => [
          'label' => 'ምስል ወደ ቀኝ ውሰድ',
        ],
        'move_up' => [
          'label' => 'ምስል ወደ ላይ ውሰድ',
        ],
        'reset' => [
          'label' => 'ዳግም አስጀምር',
        ],
        'rotate_left' => [
          'label' => 'ምስሉን ወደ ግራ አሽከርክር',
        ],
        'rotate_right' => [
          'label' => 'ምስሉን ወደ ቀኝ አሽከርክር',
        ],
        'set_aspect_ratio' => [
          'label' => 'ምጥጥን ወደ :ratio አዘጋጅ',
        ],
        'save' => [
          'label' => 'አስቀምጥ',
        ],
        'zoom_100' => [
          'label' => 'ምስልን ወደ 100% አሳንስ',
        ],
        'zoom_in' => [
          'label' => 'አሳንስ',
        ],
        'zoom_out' => [
          'label' => 'አሳንስ',
        ],
      ],
      'fields' => [
        'height' => [
          'label' => 'ቁመት',
          'unit' => 'px',
        ],
        'rotation' => [
          'label' => 'ማዞር',
          'unit' => 'ዲግ',
        ],
        'width' => [
          'label' => 'ስፋት',
          'unit' => 'px',
        ],
        'x_position' => [
          'label' => 'X',
          'unit' => 'px',
        ],
        'y_position' => [
          'label' => 'ዋይ',
          'unit' => 'px',
        ],
      ],
      'aspect_ratios' => [
        'label' => 'ምጥጥነ ገጽታ',
        'no_fixed' => [
          'label' => 'ፍርይ',
        ],
      ],
      'svg' => [
        'messages' => [
          'confirmation' => 'SVG ፋይሎችን ማስተካከል አይመከርም ምክንያቱም በሚለካበት ጊዜ የጥራት መጥፋት ሊያስከትል ይችላል።\\n እርግጠኛ ነህ መቀጠል ትፈልጋለህ?',
          'disabled' => 'በሚዛንበት ጊዜ የጥራት መጥፋት ሊያስከትል ስለሚችል የኤስቪጂ ፋይሎችን ማረም ተሰናክሏል።',
        ],
      ],
    ],
  ],
  'key_value' => [
    'actions' => [
      'add' => [
        'label' => 'ረድፍ ጨምር',
      ],
      'delete' => [
        'label' => 'ረድፍ ሰርዝ',
      ],
      'reorder' => [
        'label' => 'ረድፍ እንደገና ይዘዙ',
      ],
    ],
    'fields' => [
      'key' => [
        'label' => 'ቁልፍ',
      ],
      'value' => [
        'label' => 'ዋጋ',
      ],
    ],
  ],
  'markdown_editor' => [
    'toolbar_buttons' => [
      'attach_files' => 'ፋይሎችን ያያይዙ',
      'blockquote' => 'Blockquote',
      'bold' => 'ደፋር',
      'bullet_list' => 'የነጥብ ዝርዝር',
      'code_block' => 'ኮድ እገዳ',
      'heading' => 'ርዕስ',
      'italic' => 'ኢታሊክ',
      'link' => 'አገናኝ',
      'ordered_list' => 'ቁጥር ያለው ዝርዝር',
      'redo' => 'ድገም',
      'strike' => 'አድማ',
      'table' => 'ጠረጴዛ',
      'undo' => 'ቀልብስ',
    ],
  ],
  'radio' => [
    'boolean' => [
      'true' => 'አዎ',
      'false' => 'አይ',
    ],
  ],
  'repeater' => [
    'actions' => [
      'add' => [
        'label' => 'ወደ :label ያክሉ',
      ],
      'add_between' => [
        'label' => 'መካከል አስገባ',
      ],
      'delete' => [
        'label' => 'ሰርዝ',
      ],
      'clone' => [
        'label' => 'ክሎን።',
      ],
      'reorder' => [
        'label' => 'አንቀሳቅስ',
      ],
      'move_down' => [
        'label' => 'ወደ ታች ውሰድ',
      ],
      'move_up' => [
        'label' => 'ወደ ላይ ተንቀሳቀስ',
      ],
      'collapse' => [
        'label' => 'ሰብስብ',
      ],
      'expand' => [
        'label' => 'ዘርጋ',
      ],
      'collapse_all' => [
        'label' => 'ሁሉንም ሰብስብ',
      ],
      'expand_all' => [
        'label' => 'ሁሉንም ዘርጋ',
      ],
    ],
  ],
  'rich_editor' => [
    'dialogs' => [
      'link' => [
        'actions' => [
          'link' => 'አገናኝ',
          'unlink' => 'ግንኙነት አቋርጥ',
        ],
        'label' => 'URL',
        'placeholder' => 'URL አስገባ',
      ],
    ],
    'toolbar_buttons' => [
      'attach_files' => 'ፋይሎችን ያያይዙ',
      'blockquote' => 'Blockquote',
      'bold' => 'ደፋር',
      'bullet_list' => 'የነጥብ ዝርዝር',
      'code_block' => 'ኮድ እገዳ',
      'h1' => 'ርዕስ',
      'h2' => 'ርዕስ',
      'h3' => 'ንዑስ ርዕስ',
      'italic' => 'ኢታሊክ',
      'link' => 'አገናኝ',
      'ordered_list' => 'ቁጥር ያለው ዝርዝር',
      'redo' => 'ድገም',
      'strike' => 'አድማ',
      'underline' => 'ይሰመርበት',
      'undo' => 'ቀልብስ',
    ],
  ],
  'select' => [
    'actions' => [
      'create_option' => [
        'modal' => [
          'heading' => 'ፍጠር',
          'actions' => [
            'create' => [
              'label' => 'ፍጠር',
            ],
            'create_another' => [
              'label' => 'ሌላ ይፍጠሩ እና ይፍጠሩ',
            ],
          ],
        ],
      ],
      'edit_option' => [
        'modal' => [
          'heading' => 'አርትዕ',
          'actions' => [
            'save' => [
              'label' => 'አስቀምጥ',
            ],
          ],
        ],
      ],
    ],
    'boolean' => [
      'true' => 'አዎ',
      'false' => 'አይ',
    ],
    'loading_message' => 'በመጫን ላይ...',
    'max_items_message' => ' :count ብቻ ነው ሊመረጥ የሚችለው።',
    'no_search_results_message' => 'ከፍለጋዎ ጋር የሚዛመዱ ምንም አማራጮች የሉም።',
    'placeholder' => 'አንድ አማራጭ ይምረጡ',
    'searching_message' => 'በመፈለግ ላይ...',
    'search_prompt' => 'ለመፈለግ መተየብ ጀምር...',
  ],
  'tags_input' => [
    'placeholder' => 'አዲስ መለያ',
  ],
  'text_input' => [
    'actions' => [
      'hide_password' => [
        'label' => 'የይለፍ ቃል ደብቅ',
      ],
      'show_password' => [
        'label' => 'የይለፍ ቃል አሳይ',
      ],
    ],
  ],
  'toggle_buttons' => [
    'boolean' => [
      'true' => 'አዎ',
      'false' => 'አይ',
    ],
  ],
  'wizard' => [
    'actions' => [
      'previous_step' => [
        'label' => 'ተመለስ',
      ],
      'next_step' => [
        'label' => 'ቀጥሎ',
      ],
    ],
  ],
];