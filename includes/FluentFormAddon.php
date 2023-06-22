<?php

namespace FF_Addon;
use FF_Addon\DatePickerField;

class FluentFormAddon {

    public function __construct() {
        require_once FFA_DIR_PATH . 'includes/DataPickerField.php';
        new DatePickerField();
    }
}
