<?php

namespace FF_Addon;

use FluentForm\App\Services\FormBuilder\BaseFieldManager;
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
                'name'      => $this->key,
            ],
            'settings' => [
                'container_class'    => '',
                'admin_field_label'  => $this->title,
                'label'              => '',
                'label_placement'    => 'top',
                'start_year'         => date("Y") - 10,
                'end_year'           => date("Y") + 10
            ],
            'fields' => [
                'month' => [
                    'element'    => 'select',
                    'attributes' => [
                        'name'  => 'month',
                        'type'  => 'select',
                        'value' => date('m'),
                        'id'    => '',
                        'class' => '',
                        'placeholder' => 'Select Month',
                    ],
                    'settings' => [
                        'dynamic_default_value' => '',
                        'label'                 => __('Month', 'fluentform'),
                        'admin_field_label'     => '',
                        'help_message'          => '',
                        'container_class'       => '',
                        'label_placement'       => '',
                        'placeholder'           => '- Select Month -',
                        'calc_value_status'  => false,
                        'visible'            => true,
                        'values_visible'     => false,
                    ],
                    'editor_options' => [
                        'title'      => $this->title,
                        'template'   => 'inputText',
                    ],
                ],
                'date' => [
                    'element'    => 'select',
                    'attributes' => [
                        'name'  => 'date',
                        'type'  => 'select',
                        'value' => date("d"),
                        'id'    => '',
                        'class' => '',
                        'placeholder' => 'Select Date',
                    ],
                    'settings' => [
                        'dynamic_default_value' => '',
                        'label'                 => __('Date', 'fluentform'),
                        'admin_field_label'     => '',
                        'help_message'          => '',
                        'container_class'       => '',
                        'label_placement'       => '',
                        'placeholder'           => '- Select Date -',
                        'calc_value_status'  => false,
                        'visible'            => true,
                        'values_visible'     => false,
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
                        'placeholder' => 'Select Year',
                    ],
                    'settings' => [
                        'dynamic_default_value' => '',
                        'label'                 => __('Year', 'fluentform'),
                        'admin_field_label'     => '',
                        'help_message'          => '',
                        'container_class'       => '',
                        'label_placement'       => '',
                        'placeholder'           => '- Select Year -',
                        'calc_value_status'  => false,
                        'visible'            => true,
                        'values_visible'     => false,
                    ],
                    'editor_options' => [
                        'title'      => $this->title,
                        'template'   => 'inputText',
                    ],
                ],
            ],
            'editor_options' => [
                'title'      => $this->title,
                'element'    => 'name-fields',
                'icon_class' => 'ff-edit-three-column',
                'template'   => 'nameFields',
            ],
        ];
    }

    public function generalEditorElement()
    {
        return [
            'start_year'       => [
                'template'  => 'inputNumber',
                'label'     => __('Start Year'),
                'help_text' => __('Enter the Start Year'),
            ],
            'end_year'       => [
                'template'  => 'inputNumber',
                'label'     => __('End Year'),
                'help_text' => __('Enter the End Year'),
            ]
        ];
    }

    public function render($data, $form)
    {
        $data['attributes']['id'] = $this->makeElementId($data, $form);
        return (new SelectDate())->compile($data, $form);
    }
}