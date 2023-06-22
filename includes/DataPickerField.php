<?php

namespace FF_Addon;

use FluentForm\App\Services\FormBuilder\BaseFieldManager;
use FluentForm\App\Services\FormBuilder\Components\Text;
use FluentForm\Framework\Helpers\ArrayHelper;

class DatePickerField extends BaseFieldManager {
    
    public function __construct()
    {
        parent::__construct(
            'date_picker_field',
            'Date Picker',
            ['date', 'picker'],
            'general'
        );
    }

    public function getComponent()
    {
        return [
            'index'           => 16,
            'element'         => $this->key,
            'attributes'      => [
                'name'                => $this->key,
                'class'               => 'datepicker-input',
                'value'               => '',
                'type'                => 'text',
                'placeholder'         => ''
            ],
            'settings'       => [
                'container_class'     => '',
                'placeholder'         => '',
                'auto_select_country' => 'no',
                'label'               => $this->title,
                'label_placement'     => '',
                'help_message'        => '',
                'validate_on_change'  => false,
                'target_input'        => '',
                'error_message'       => __('Invalid Date Formate', 'text-domain'),
                'validation_rules'    => [
                    'required' => [
                        'value'   => false,
                        'message' => __('This field is required', 'text-domain'),
                    ]
                ],
                'conditional_logics'  => []
            ],
            'editor_options' => [
                'title'      => $this->title . ' Field',
                'icon_class' => 'ff-edit-date',
                'template'   => 'inputText'
            ],
        ];
    }

    public function generalEditorElement()
    {
        return [];
    }

    public function render($data, $form)
    {
        $data['attributes']['id'] = $this->makeElementId($data, $form);
        $this->pushScript();
        return (new Text())->compile($data, $form);
    }

    public function pushScript(){
        wp_enqueue_style('zebra-datepicker', 'https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/bootstrap/zebra_datepicker.min.css', [], '1.0.0');
        wp_enqueue_script('zebra-datepicker', 'https://cdn.jsdelivr.net/npm/zebra_datepicker@1.9.13/dist/zebra_datepicker.min.js', ['jquery'], '1.0.0', true);
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                function initDatePicker(){
                    $('input.datepicker-input').Zebra_DatePicker({
                        direction: true,
                    });
                }
                initDatePicker();
            });
        </script>
        
        <?php
    }

    public function pushConditionalSupport($conditonalItems)
    {
        return $conditonalItems;
    }

    public function pushFormInputType($types)
    {
        return $types;
    }
}