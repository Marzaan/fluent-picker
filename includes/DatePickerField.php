<?php

namespace FF_Addon;

use FluentForm\App\Services\FormBuilder\BaseFieldManager;
use FluentForm\App\Services\FormBuilder\Components\Text;
use FluentForm\Framework\Helpers\ArrayHelper;

class DatePickerField extends BaseFieldManager {
    
    public function __construct()
    {
        parent::__construct(
            'date_field',
            'Date Field',
            ['date', 'picker'],
            'general'
        );
    }

    public function getComponent()
    {
        return [
            'index'      => 16,
            'element'    => $this->key,
            'attributes' => [
                'type'        => 'text',
                'name'        => $this->key,
                'value'       => '',
                'id'          => '',
                'class'       => 'pickaday-datepicker',
                'placeholder' => '',
                'autoComplete' => 'off'
            ],
            'settings' => [
                'container_class'     => '',
                'placeholder'         => '',
                'label'               => $this->title,
                'label_placement'     => 'top',
                'help_message'        => '',
                'validate_on_change'  => false,
                'start_year_input'    => date("Y") - 10,
                'end_year_input'      => date("Y") + 10,
                'date_format_select'  => 'MM/DD/YYYY',
                'validation_rules'   => [
                    'required' => [
                        'value'   => false,
                        'message' => __('This field is required', 'fluentform'),
                    ],
                ]
            ],
            'editor_options' => [
                'title'      => $this->title,
                'icon_class' => 'ff-edit-date',
                'template'   => 'inputText',
            ],
        ];
    }

    public function generalEditorElement()
    {
        return [
            'date_format_select'      => [
                'template' => 'select',
                'label'    => 'Date Format',
                'help_text' => __('Select a Date Format', 'text-domain'),
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
            'start_year_input'       => [
                'template'  => 'inputNumber',
                'label'     => __('Start Year'),
                'help_text' => __('Enter the Start Year'),
            ],
            'end_year_input'       => [
                'template'  => 'inputNumber',
                'label'     => __('End Year'),
                'help_text' => __('Enter the End Year'),
            ]
        ];
    }

    public function render($data, $form)
    {
        $data['attributes']['id'] = $this->makeElementId($data, $form);
        $this->pushScript($data);
        return (new Text())->compile($data, $form);
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
                            const day = ("0" + (date.getDate() + 1)).slice(-2);
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
                            const day = ("0" + (date.getDate() + 1)).slice(-2);
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
                        dateFormat = '<?php echo esc_html($data['settings']['date_format_select'])?>';
                        dateFormatOption = dateFormatOptions[dateFormat];
                        toString = dateFormatOption.toString;
                        parse = dateFormatOption.parse;

                        // Start Year
                        startYearInput = '<?php echo esc_html($data['settings']['start_year_input'])?>';
                        startYear = parseInt(startYearInput, 10);

                        // End Year
                        endYearInput = '<?php echo esc_html($data['settings']['end_year_input'])?>';
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