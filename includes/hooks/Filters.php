<?php

function addCustomShortcode($group, $form)
{
    $group[] = [
        'title' => 'Custom Shortcode', 
        'shortcodes' => [
            '{inputs.multi_select_date}' => __('Date Input', 'fluentform')
        ]
    ];
    return $group;
}
add_filter('fluentform/form_settings_smartcodes', 'addCustomShortcode', 10, 2);

function addInputShortcode($editorShortCodes, $form)
{
    $editorShortCodes[0]['shortcodes']['{inputs.multi_select_date}'] = __("Test Input ShortCode", 'fluentform');
    return $editorShortCodes;
}
add_filter('fluentform/all_editor_shortcodes', 'addInputShortcode', 10, 2);

add_filter('fluentform/response_render_multi_select_date', function ($value, $field) {
    return \FF_Addon\Form\FormDataParser::formatSelectDate($value, $field);
}, 10, 2);
