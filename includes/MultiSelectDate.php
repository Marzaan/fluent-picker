<?php

namespace FF_Addon;

use FluentForm\App\Services\FormBuilder\BaseFieldManager;
use FluentForm\App\Services\FormBuilder\Components\Text;
use FluentForm\Framework\Helpers\ArrayHelper;
use FF_Addon\Components\SelectDate;

class MultiSelectDate extends BaseFieldManager {
    
    public function __construct()
    {
        parent::__construct(
            'multi_select_date',
            'Multi Select Date',
            ['multi', 'select', 'date'],
            'general'
        );
    }

    public function getComponent()
    {
        return [
            'index'      => 17,
            'element'    => $this->key,
            'attributes' => [
                'name'          => $this->key,            ],
            'settings' => [
                'container_class'    => '',
                'admin_field_label'  => __('Date', 'fluentform'),
                'date_type'          => 'single',
                'date_fields'        => '',
            ],
            'single_field'  => [
                'attributes' => [
                    'type'        => 'text',
                    'name'        => 'multi_select_date',
                    'value'       => date("m/d/Y"),
                    'id'          => '',
                    'placeholder' => 'Pick a date',
                    'autoComplete'=> 'off'
                ],
                'settings' => [
                    'container_class'    => '',
                    'help_message'       => '',
                    'label'              => __('Date', 'fluentform'),
                    'label_placement'    => 'top',
                    'date_format'        => 'MM/DD/YYYY',
                    'start_year'         => date("Y") - 10,
                    'end_year'           => date("Y") + 10,
                    'validation_rules'   => [
                        'required' => [
                            'value'   => true,
                            'message' => __('This field is required', 'fluentform'),
                        ],
                    ]
                ],
                'editor_elements' => [
                    'label_placement' => [
                        'label'     => __('Label Placement', 'fluentform'),
                        'help_text' => __('Determine the position of label title where the user will see this. By choosing "Default", global label placement setting will be applied.', 'fluentform'),
                        'options'   => [
                            [
                                'value' => '',
                                'label' => __('Default', 'fluentform'),
                            ],
                            [
                                'value' => 'top',
                                'label' => __('Top', 'fluentform'),
                            ],
                            [
                                'value' => 'right',
                                'label' => __('Right', 'fluentform'),
                            ],
                            [
                                'value' => 'bottom',
                                'label' => __('Bottom', 'fluentform'),
                            ],
                            [
                                'value' => 'left',
                                'label' => __('Left', 'fluentform'),
                            ],
                            [
                                'value' => 'hide_label',
                                'label' => __('Hide Label', 'fluentform'),
                            ]
                        ]
                    ],
                    'date_format'      => [
                        'template' => 'select',
                        'label'    => 'Date Format',
                        'help_text' => __('Select a Date Format', 'fluentform'),
                        'options'   => [
                            [
                                'value' => 'M/D/YY',
                                'label' => __('M/D/YY - (Ex: 6/6/23)'),
                            ],
                            [
                                'value' => 'MM/DD/YYYY',
                                'label' => __('MM/DD/YYYY - (Ex: 06/23/2023)'),
                            ],
                            [
                                'value' => 'DD/MM/YYYY',
                                'label' => __('DD/MM/YYYY - (Ex: 23/06/2023)'),
                            ],
                            [
                                'value' => 'MM-DD-YYYY',
                                'label' => __('MM-DD-YYYY - (Ex: 06-23-2023)'),
                            ],
                            [
                                'value' => 'MM.DD.YYYY',
                                'label' => __('MM.DD.YYYY - (Ex: 06.23.2023)'),
                            ]
                        ],
                    ],
                    'start_year'          => [
                        'label'     => __('Start Year', 'fluentform'),
                        'type'      => 'number', 
                        'help_text' => __('Enter the Start Year', 'fluentform'),
                    ],
                    'end_year'            => [
                        'label'     => __('End Year'),
                        'type'      => 'number',
                        'help_text' => __('Enter the End Year', 'fluentform'),
                    ],
                ],
                'editor_options' => [
                    'title'      => 'Date Field',
                    'icon_class' => 'ff-edit-date',
                    'template'   => 'inputText',
                ],
            ],
            'multi_field' => [
                'fields' => [
                    'date' => [
                        'element'    => 'select',
                        'attributes' => [
                            'name'  => 'date',
                            'type'  => 'select',
                            'value' => date("d"),
                            'id'    => '',
                            'class' => '',
                            'placeholder' => '-- Select Date --',
                        ],
                        'settings' => [
                            'label'                 => __('Date', 'fluentform'),
                            'help_message'          => '',
                            'placeholder'           => '-- Select Date --',
                            'calc_value_status'     => false,
                            'visible'               => true,
                            'values_visible'        => false,
                            'validation_rules'      => [
                                'required' => [
                                    'value'   => false,
                                    'message' => __('This field is required', 'fluentform'),
                                ],
                            ]
                        ],
                        'editor_options' => [
                            'title'      => $this->title,
                            'template'   => 'inputText',
                        ],
                    ],
                    'month' => [
                        'element'    => 'select',
                        'attributes' => [
                            'name'  => 'month',
                            'type'  => 'select',
                            'value' => date('F'),
                            'id'    => '',
                            'class' => '',
                            'placeholder' => '-- Select Month --',
                        ],
                        'settings' => [
                            'label'                 => __('Month', 'fluentform'),
                            'help_message'          => '',
                            'placeholder'           => '-- Select Month --',
                            'calc_value_status'     => false,
                            'visible'               => true,
                            'values_visible'        => false,
                            'validation_rules'      => [
                                'required' => [
                                    'value'   => false,
                                    'message' => __('This field is required', 'fluentform'),
                                ],
                            ]
                        ],
                        'editor_options' => [
                            'title'      => $this->title,
                            'template'   => 'inputText',
                        ],
                    ],
                    'year' => [
                        'element'    => 'select',
                        'attributes' => [
                            'name'  => 'year',
                            'type'  => 'select',
                            'value' => date("Y"),
                            'id'    => '',
                            'class' => '',
                            'placeholder' => '-- Select Year --',
                        ],
                        'settings' => [
                            'label'                 => __('Year', 'fluentform'),
                            'help_message'          => '',
                            'placeholder'           => '-- Select Year --',
                            'calc_value_status'     => false,
                            'visible'               => true,
                            'values_visible'        => false,
                            'start_year'          => [
                                'label'     => __('Start Year'),
                                'type'      => 'number', 
                                'value'     => date("Y") - 10,
                                'help_text' => __('Enter the Start Year'),
                            ],
                            'end_year'            => [
                                'label'     => __('End Year'),
                                'type'      => 'number',
                                'value'     => date("Y") + 10,
                                'help_text' => __('Enter the End Year'),
                            ],
                            'validation_rules'      => [
                                'required' => [
                                    'value'   => false,
                                    'message' => __('This field is required', 'fluentform'),
                                ],
                            ]
                        ],
                        'editor_options' => [
                            'title'      => $this->title,
                            'template'   => 'inputText',
                        ],
                    ],                   
                ],
                'settings' => [
                    'label'                 => '',
                    'label_placement'       => 'top',
                    'date_format'        => 'd/m/Y',
                ],
                'editor_elements' => [
                    'label_placement' => [
                        'label'     => __('Label Placement', 'fluentform'),
                        'help_text' => __('Determine the position of label title where the user will see this. By choosing "Default", global label placement setting will be applied.', 'fluentform'),
                        'options'   => [
                            [
                                'value' => '',
                                'label' => __('Default', 'fluentform'),
                            ],
                            [
                                'value' => 'top',
                                'label' => __('Top', 'fluentform'),
                            ],
                            [
                                'value' => 'right',
                                'label' => __('Right', 'fluentform'),
                            ],
                            [
                                'value' => 'bottom',
                                'label' => __('Bottom', 'fluentform'),
                            ],
                            [
                                'value' => 'left',
                                'label' => __('Left', 'fluentform'),
                            ],
                            [
                                'value' => 'hide_label',
                                'label' => __('Hide Label', 'fluentform'),
                            ]
                        ]
                    ],
                    'date_format'      => [
                        'template' => 'select',
                        'label'    => 'Output Format',
                        'help_text' => __('Select a Date Format that will be displayed in the response', 'fluentform'),
                        'options'   => $this->getDateFormatOptions(),
                    ],
                ],

            ],
            'editor_options' => [
                'title'      => $this->title,
                'element'    => 'date-fields',
                'icon_class' => 'ff-edit-three-column',
                'template'   => 'dateFields',
            ],
        ];
    }

    public function generalEditorElement()
    {
        return [
            'date_type'       => [
                'template'  => 'radio',
                'label'     => __('Date Type', 'fluentform'),
                'help_text' => __('Select a date type', 'fluentform'),
                'options'   => [
                    [
                        'value' => 'single',
                        'label' => __('Single Field', 'fluentform'),
                    ],
                    [
                        'value' => 'multiple',
                        'label' => __('Multiple Fields', 'fluentform'),
                    ],
                ],
            ],
            'date_fields'       => [
                'template'  => 'dateFields',
                'label'     => __('Date Fields'),
            ]
        ];
    }

    public function render($data, $form)
    {
        switch ($data['settings']['date_type']) {
            case 'multiple':
                $data['attributes']['id'] = $this->makeElementId($data, $form);
                return (new SelectDate())->compile($data, $form);
            default:
                $data['attributes']['id'] = $this->makeElementId($data, $form);
                $this->pushScript($data);
                return (new Text())->compile($data['single_field'], $form);
        }
    }

    public function getDateFormatOptions()
    {
        $dateFormats = [
            'm/d/Y'       => 'm/d/Y - (Ex: 04/28/2018)', // USA
            'd/m/Y'       => 'd/m/Y - (Ex: 28/04/2018)', // Canada, UK
            'd.m.Y'       => 'd.m.Y - (Ex: 28.04.2019)', // Germany
            'n/j/y'       => 'n/j/y - (Ex: 4/28/18)',
            'm/d/y'       => 'm/d/y - (Ex: 04/28/18)',
            'M/d/Y'       => 'M/d/Y - (Ex: Apr/28/2018)',
            'y/m/d'       => 'y/m/d - (Ex: 18/04/28)',
            'Y-m-d'       => 'Y-m-d - (Ex: 2018-04-28)',
            'd-M-y'       => 'd-M-y - (Ex: 28-Apr-18)',
            'm/d/Y h:i K' => 'm/d/Y h:i K - (Ex: 04/28/2018 08:55 PM)', // USA
            'm/d/Y H:i'   => 'm/d/Y H:i - (Ex: 04/28/2018 20:55)', // USA
            'd/m/Y h:i K' => 'd/m/Y h:i K - (Ex: 28/04/2018 08:55 PM)', // Canada, UK
            'd/m/Y H:i'   => 'd/m/Y H:i - (Ex: 28/04/2018 20:55)', // Canada, UK
            'd.m.Y h:i K' => 'd.m.Y h:i K - (Ex: 28.04.2019 08:55 PM)', // Germany
            'd.m.Y H:i'   => 'd.m.Y H:i - (Ex: 28.04.2019 20:55)', // Germany
            'h:i K'       => 'h:i K (Only Time Ex: 08:55 PM)',
            'H:i'         => 'H:i (Only Time Ex: 20:55)',
        ];

        $formatOptions = [];
        foreach ($dateFormats as $format => $label) {
            $formatOptions[] = [
                'value' => $format,
                'label' => $label,
            ];
        }
        return $formatOptions;
    }

    public function pushScript( $data ){
        wp_enqueue_style('pickaday-datepicker', 'https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css', [], '1.0.0');
        wp_enqueue_script('pickaday-datepicker', 'https://cdn.jsdelivr.net/npm/pikaday/pikaday.js', ['jquery'], '1.0.0', true);?>
        
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                const dateFormatOptions = {
                    'M/D/YY': {
                        format: 'M/D/YY',
                        toString(date) {
                            const day = date.getDate() + 1;
                            const month = date.getMonth() + 1;
                            const year = ('0' + date.getFullYear()).slice(-2); // Converting to String and slicing last 2 digits
                            return `${month}/${day}/${year}`;
                        },
                        parse(dateString) {
                            const parts = dateString.split('/');
                            const day = parseInt(parts[1], 10);
                            const month = parseInt(parts[0], 10) - 1;
                            const year = parseInt(parts[2], 10);
                            return new Date(year, month, day);
                        }
                    },
                    'MM/DD/YYYY': {
                        format: 'MM/DD/YYYY',
                        toString(date) {
                            const day = ("0" + (date.getDate())).slice(-2);
                            const month = ("0" + (date.getMonth() + 1)).slice(-2);
                            const year = date.getFullYear();
                            return `${month}/${day}/${year}`;
                        },
                        parse(dateString) {
                            const parts = dateString.split('/');
                            const day = parseInt(parts[1], 10);
                            const month = parseInt(parts[0], 10) - 1;
                            const year = parseInt(parts[2], 10);
                            return new Date(year, month, day);
                        }
                    },
                    'DD/MM/YYYY': {
                        format: 'DD/MM/YYYY',
                        toString(date) {
                            const day = ("0" + (date.getDate())).slice(-2);
                            const month = ("0" + (date.getMonth() + 1)).slice(-2);
                            const year = date.getFullYear();
                            return `${day}/${month}/${year}`;
                        },
                        parse(dateString) {
                            const parts = dateString.split('/');
                            const day = parseInt(parts[0], 10);
                            const month = parseInt(parts[1], 10) - 1;
                            const year = parseInt(parts[2], 10);
                            return new Date(year, month, day);
                        }
                    },
                    'MM-DD-YYYY': {
                        format: 'MM-DD-YYYY',
                        toString(date) {
                            const day = ("0" + (date.getDate() + 1)).slice(-2);
                            const month = ("0" + (date.getMonth() + 1)).slice(-2);
                            const year = date.getFullYear();
                            return `${month}-${day}-${year}`;
                        },
                        parse(dateString) {
                            const parts = dateString.split('-');
                            const day = parseInt(parts[1], 10);
                            const month = parseInt(parts[0], 10) - 1;
                            const year = parseInt(parts[2], 10);
                            return new Date(year, month, day);
                        }
                    },
                    'MM.DD.YYYY': {
                        format: 'MM.DD.YYYY',
                        toString(date) {
                            const day = ("0" + (date.getDate() + 1)).slice(-2);
                            const month = ("0" + (date.getMonth() + 1)).slice(-2);
                            const year = date.getFullYear();
                            return `${month}.${day}.${year}`;
                        },
                        parse(dateString) {
                            const parts = dateString.split('.');
                            const day = parseInt(parts[1], 10);
                            const month = parseInt(parts[0], 10) - 1;
                            const year = parseInt(parts[2], 10);
                            return new Date(year, month, day);
                        }                        
                    }
                };
                function initDatePicker(){
                    let startYearInput, endYearInput, startYear, endYear, dateFormat, dateFormatOption, toString, parse;
                    // Date Format
                    dateFormat = '<?php echo esc_html($data['single_field']['settings']['date_format'])?>';
                    dateFormatOption = dateFormatOptions[dateFormat];
                    toString = dateFormatOption.toString;
                    parse = dateFormatOption.parse;

                    // Start Year
                    startYearInput = '<?php echo esc_html($data['single_field']['settings']['start_year'])?>';
                    startYear = parseInt(startYearInput, 10);

                    // End Year
                    endYearInput = '<?php echo esc_html($data['single_field']['settings']['end_year'])?>';
                    endYear = parseInt(endYearInput, 10);

                    // Init Date Picker
                    new Pikaday({
                        field: $('#<?php echo esc_attr($data['attributes']['id'])?>')[0],
                        yearRange: [startYear, endYear],
                        format: dateFormat,
                        toString: toString,
                        parse: parse,
                    });
                }
                initDatePicker();
            });
        </script>
        
        <?php
    }
}