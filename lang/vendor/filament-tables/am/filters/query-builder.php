<?php 
return [
  'label' => 'መጠይቅ ገንቢ',
  'form' => [
    'operator' => [
      'label' => 'ኦፕሬተር',
    ],
    'or_groups' => [
      'label' => 'ቡድኖች',
      'block' => [
        'label' => 'መከፋፈል (OR)',
        'or' => 'ወይም',
      ],
    ],
    'rules' => [
      'label' => 'ደንቦች',
      'item' => [
        'and' => 'እና',
      ],
    ],
  ],
  'no_rules' => '(ደንብ የለም)',
  'item_separators' => [
    'and' => 'እና',
    'or' => 'ወይም',
  ],
  'operators' => [
    'is_filled' => [
      'label' => [
        'direct' => 'ተሞልቷል።',
        'inverse' => 'ባዶ ነው።',
      ],
      'summary' => [
        'direct' => ':attribute ተሞልቷል',
        'inverse' => ':attribute ባዶ ነው።',
      ],
    ],
    'boolean' => [
      'is_true' => [
        'label' => [
          'direct' => 'እውነት ነው',
          'inverse' => 'ውሸት ነው።',
        ],
        'summary' => [
          'direct' => ':attribute እውነት ነው።',
          'inverse' => ':attribute ውሸት ነው።',
        ],
      ],
    ],
    'date' => [
      'is_after' => [
        'label' => [
          'direct' => 'በኋላ ነው።',
          'inverse' => 'በኋላ አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute ከ :date በኋላ ነው።',
          'inverse' => ':attribute ከ :date በኋላ አይደለም።',
        ],
      ],
      'is_before' => [
        'label' => [
          'direct' => 'በፊት ነው።',
          'inverse' => 'በፊት አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute ከ :date በፊት ነው።',
          'inverse' => ':attribute ከ :date በፊት አይደለም።',
        ],
      ],
      'is_date' => [
        'label' => [
          'direct' => 'ቀን ነው።',
          'inverse' => 'ቀን አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute :date ነው።',
          'inverse' => ':attribute :date አይደለም።',
        ],
      ],
      'is_month' => [
        'label' => [
          'direct' => 'ወር ነው።',
          'inverse' => 'ወር አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute :month ነው።',
          'inverse' => ':attribute :month አይደለም።',
        ],
      ],
      'is_year' => [
        'label' => [
          'direct' => 'ዓመት ነው።',
          'inverse' => 'ዓመት አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute :year ነው።',
          'inverse' => ':attribute :year አይደለም።',
        ],
      ],
      'form' => [
        'date' => [
          'label' => 'ቀን',
        ],
        'month' => [
          'label' => 'ወር',
        ],
        'year' => [
          'label' => 'አመት',
        ],
      ],
    ],
    'number' => [
      'equals' => [
        'label' => [
          'direct' => 'እኩል ነው።',
          'inverse' => 'እኩል አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute ከ :number ጋር እኩል ነው።',
          'inverse' => ':attribute ከ :number ጋር እኩል አይደለም።',
        ],
      ],
      'is_max' => [
        'label' => [
          'direct' => 'ከፍተኛ ነው።',
          'inverse' => 'ይበልጣል',
        ],
        'summary' => [
          'direct' => ':attribute ከፍተኛው :number ነው።',
          'inverse' => ':attribute ከ :number ይበልጣል',
        ],
      ],
      'is_min' => [
        'label' => [
          'direct' => 'ዝቅተኛ ነው',
          'inverse' => 'ያነሰ ነው።',
        ],
        'summary' => [
          'direct' => ':attribute ዝቅተኛው :number ነው።',
          'inverse' => ':attribute ከ :number ያነሰ ነው።',
        ],
      ],
      'aggregates' => [
        'average' => [
          'label' => 'አማካኝ',
          'summary' => 'አማካይ :attribute',
        ],
        'max' => [
          'label' => 'ከፍተኛ',
          'summary' => 'ከፍተኛ :attribute',
        ],
        'min' => [
          'label' => 'ደቂቃ',
          'summary' => 'ደቂቃ :attribute',
        ],
        'sum' => [
          'label' => 'ድምር',
          'summary' => 'የ :attribute ድምር',
        ],
      ],
      'form' => [
        'aggregate' => [
          'label' => 'ድምር',
        ],
        'number' => [
          'label' => 'ቁጥር',
        ],
      ],
    ],
    'relationship' => [
      'equals' => [
        'label' => [
          'direct' => 'ያለው',
          'inverse' => 'የለውም',
        ],
        'summary' => [
          'direct' => ' :count :relationship አለው።',
          'inverse' => ' :count :relationship የለውም',
        ],
      ],
      'has_max' => [
        'label' => [
          'direct' => 'ከፍተኛው አለው።',
          'inverse' => 'በላይ ያለው',
        ],
        'summary' => [
          'direct' => 'ከፍተኛው :count :relationship አለው።',
          'inverse' => 'ከ :count :relationship በላይ አለው።',
        ],
      ],
      'has_min' => [
        'label' => [
          'direct' => 'ዝቅተኛው አለው',
          'inverse' => 'ያነሰ አለው',
        ],
        'summary' => [
          'direct' => 'ቢያንስ :count :relationship አለው።',
          'inverse' => 'ከ :count :relationship ያነሰ አለው።',
        ],
      ],
      'is_empty' => [
        'label' => [
          'direct' => 'ባዶ ነው።',
          'inverse' => 'ባዶ አይደለም',
        ],
        'summary' => [
          'direct' => ':relationship ባዶ ነው።',
          'inverse' => ':relationship ባዶ አይደለም።',
        ],
      ],
      'is_related_to' => [
        'label' => [
          'single' => [
            'direct' => 'ነው',
            'inverse' => 'አይደለም',
          ],
          'multiple' => [
            'direct' => 'ይዟል',
            'inverse' => 'አልያዘም።',
          ],
        ],
        'summary' => [
          'single' => [
            'direct' => ':relationship :values ነው።',
            'inverse' => ':relationship :values አይደለም።',
          ],
          'multiple' => [
            'direct' => ':relationship :values ይዟል',
            'inverse' => ':relationship :values አልያዘም።',
          ],
          'values_glue' => [
            0 => ',',
            'final' => 'ወይም',
          ],
        ],
        'form' => [
          'value' => [
            'label' => 'ዋጋ',
          ],
          'values' => [
            'label' => 'እሴቶች',
          ],
        ],
      ],
      'form' => [
        'count' => [
          'label' => 'መቁጠር',
        ],
      ],
    ],
    'select' => [
      'is' => [
        'label' => [
          'direct' => 'ነው',
          'inverse' => 'አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute :values ነው።',
          'inverse' => ':attribute :values አይደለም።',
          'values_glue' => [
            0 => ',',
            'final' => 'ወይም',
          ],
        ],
        'form' => [
          'value' => [
            'label' => 'ዋጋ',
          ],
          'values' => [
            'label' => 'እሴቶች',
          ],
        ],
      ],
    ],
    'text' => [
      'contains' => [
        'label' => [
          'direct' => 'ይዟል',
          'inverse' => 'አልያዘም።',
        ],
        'summary' => [
          'direct' => ':attribute :text ይዟል',
          'inverse' => ':attribute :text አልያዘም።',
        ],
      ],
      'ends_with' => [
        'label' => [
          'direct' => 'በዚህ ያበቃል',
          'inverse' => 'አያልቅም።',
        ],
        'summary' => [
          'direct' => ':attribute በ :text ያበቃል',
          'inverse' => ':attribute በ :text አያልቅም።',
        ],
      ],
      'equals' => [
        'label' => [
          'direct' => 'እኩል ነው።',
          'inverse' => 'እኩል አይደለም',
        ],
        'summary' => [
          'direct' => ':attribute ከ :text ጋር እኩል ነው።',
          'inverse' => ':attribute ከ :text ጋር እኩል አይደለም።',
        ],
      ],
      'starts_with' => [
        'label' => [
          'direct' => 'ይጀምራል',
          'inverse' => 'በ አይጀምርም።',
        ],
        'summary' => [
          'direct' => ':attribute በ :text ይጀምራል',
          'inverse' => ':attribute በ :text አይጀምርም።',
        ],
      ],
      'form' => [
        'text' => [
          'label' => 'ጽሑፍ',
        ],
      ],
    ],
  ],
  'actions' => [
    'add_rule' => [
      'label' => 'ደንብ ጨምር',
    ],
    'add_rule_group' => [
      'label' => 'የደንብ ቡድን ያክሉ',
    ],
  ],
];