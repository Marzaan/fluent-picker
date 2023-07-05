<?php

namespace FF_Addon\Form;

class FormDataParser{

    public static function formatSelectDate($value)
    {
        if (is_array($value) || is_object($value)) {
            return fluentImplodeRecursive(' ', array_filter(array_values((array) $value)));
        }
        
        return $value;
    }
}