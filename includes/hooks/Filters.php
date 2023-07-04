<?php

add_filter('fluentform/response_render_multi_select_date', function ($response) {
    return \FF_Addon\Form\FormDataParser::formatSelectDate($response);
}, 10, 1);