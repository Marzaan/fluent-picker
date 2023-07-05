<?php

namespace FF_Addon\Components;

use FluentForm\App\Helpers\Helper;
use FluentForm\Framework\Helpers\ArrayHelper;
use FluentForm\App\Services\FormBuilder\Components\Select;

class SelectDate extends Select
{
    /**
     * Compile and echo the html element
     *
     * @param array     $data [element data]
     * @param \stdClass $form [Form Object]
     *
     * @return void
     */
    public function compile($data, $form)
    {
        $elementName = $data['element'];
        $startYear = ArrayHelper::get($data, 'settings.start_year');
        $endYear = ArrayHelper::get($data, 'settings.end_year');

        $data = apply_filters_deprecated(
            'fluentform_rendering_field_data_' . $elementName,
            [
                $data,
                $form
            ],
            FLUENTFORM_FRAMEWORK_UPGRADE,
            'fluentform/rendering_field_data_' . $elementName,
            'Use fluentform/rendering_field_data_' . $elementName . ' instead of fluentform_rendering_field_data_' . $elementName
        );
        
        $data = apply_filters('fluentform/rendering_field_data_' . $elementName, $data, $form);

        $rootName = $data['attributes']['name'];

        if (! isset($data['attributes']['class'])) {
            $data['attributes']['class'] = '';
        }

        $data['attributes']['class'] .= ' ff-field_container ff-name-field-wrapper';
        if ($containerClass = ArrayHelper::get($data, 'settings.container_class')) {
            $data['attributes']['class'] .= ' ' . $containerClass;
        }
        $atts = $this->buildAttributes(
            ArrayHelper::except($data['attributes'], 'name')
        );

        $html = "<div {$atts}>";
        $html .= "<div class='ff-t-container'>";

        $labelPlacement = ArrayHelper::get($data, 'settings.label_placement');
        $labelPlacementClass = '';

        if ($labelPlacement) {
            $labelPlacementClass = ' ff-el-form-' . $labelPlacement;
        }
        
        foreach ($data['fields'] as $field) {
            if($field['settings']['visible']) {
                $fieldName = $field['attributes']['name'];
                $field['attributes']['name'] = $rootName . '[' . $fieldName . ']';
                @$field['attributes']['class'] = trim('ff-el-form-control ' . $field['attributes']['class']);
                
                if ($tabIndex = Helper::getNextTabIndex()) {
                    $field['attributes']['tabindex'] = $tabIndex;
                }
                $field['attributes']['data-calc_value'] = 0;

                @$field['settings']['container_class'] .= $labelPlacementClass;

                if('month' === $fieldName){
                    $field['settings']['advanced_options'] = $this->getMonthOptions();
                }
                else if('year' === $fieldName){
                    $field['settings']['advanced_options'] = $this->getYearOptions($startYear, $endYear);
                }
                else if('date' === $fieldName){
                    $field['settings']['advanced_options'] = $this->getDateOptions();
                }

                $field['attributes']['id'] = $this->makeElementId($field, $form);
                $atts = $this->buildAttributes($field['attributes']);

                
                $defaultValues = (array) $this->extractValueFromAttributes($field);
                
                $options = $this->buildOptions($field, $defaultValues);
                
                $elMarkup = '<select ' . $atts . ' aria-invalid="false">' . $options . '</select>';
                
                $selectMarkup = $this->buildElementMarkup($elMarkup, $field, $form);
                $html .= "<div class='ff-t-cell " . "'>{$selectMarkup}</div>";
            }
        }
        
        $html .= '</div>';
        $html .= '</div>';
        
        $html = apply_filters_deprecated(
            'fluentform_rendering_field_html_' . $elementName,
            [
                $html,
                $data,
                $form
            ],
            FLUENTFORM_FRAMEWORK_UPGRADE,
            'fluentform/rendering_field_html_' . $elementName,
            'Use fluentform/rendering_field_html_' . $elementName . ' instead of fluentform_rendering_field_html_' . $elementName
        );
        
        $this->pushScripts($data['attributes']['id']);
        $this->printContent('fluentform/rendering_field_html_' . $elementName, $html, $data, $form);
    }

    public function getMonthOptions(){
        $options = [];
        for($i = 1; $i <= 12; $i++){
            $monthName = date('F', mktime(0, 0, 0, $i, 10));
            $options[] = [
                'label' => $monthName,
                'value' => $monthName,
            ];
        }
        return $options;
    }

    public function getYearOptions($startYear, $endYear){
        $options = [];
        for($i = $startYear; $i <= $endYear; $i++){
            $options[] = [
                'label' => $i,
                'value' => $i,
            ];
        }
        return $options;
    }

    public function getDateOptions(){
        $dayInMonth = date('t');
        $options = [];
        for($i = 1; $i <= $dayInMonth; $i++){
            $dayValue = sprintf('%02d', $i);
            $options[] = [
                'label' => $dayValue,
                'value' => $dayValue,
            ];
        }
        return $options;
    }

    public function pushScripts($id){
        ?>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    function updateDateOptions(){
                        const date  = dateID.val();
                        const year = yearID.val();
                        const monthName = monthID.val();

                        // Get the month value from month name
                        const dateFromMonth = new Date(`${monthName} 1, 2000`);
                        const monthValue = dateFromMonth.getMonth() + 1;
                        
                        // Get the number of days in the selected month
                        dayInMonth = new Date(year, monthValue, 0).getDate();

                        // Clear existing options
                        dateID.empty();

                        // Add the new options
                        for (let i = 1; i <= dayInMonth; i++) {
                            const dayValue = ('0' + i).slice(-2);
                            const optionElement = $('<option>', {
                                value: dayValue,
                                text: dayValue
                            });
                            dateID.append(optionElement);
                        }

                        // Update the selected date to the last day of the month if the previous date is greater than the number of days in the month
                        dateID.val((date > dayInMonth) ? dayInMonth : date);
                    }
                    const monthID = $('#<?php echo $id; ?>_month_');
                    const yearID = $('#<?php echo $id; ?>_year_');
                    const dateID = $('#<?php echo $id; ?>_date_');

                    // Apply the event handler to both monthID and yearID
                    monthID.on('change', updateDateOptions);
                    yearID.on('change', updateDateOptions);
                });

            </script>
        <?php
    }
}
