<?php

namespace FF_Addon\Form;

use FluentForm\Framework\Helpers\ArrayHelper;

class FormDataParser{

    public static function formatSelectDate($value, $field)
    {

        $date_type = ArrayHelper::get($field, 'raw.settings.date_type');
        $date_format = ArrayHelper::get($field, 'raw.multi_field.settings.date_format');

        if ($date_type === 'multiple' && (is_array($value) || is_object($value))) {
            $dateValue = fluentImplodeRecursive(' ', array_filter(array_values((array) $value)));
            $value = date_format(date_create($dateValue), $date_format);
        }

        return $value;
    }
}