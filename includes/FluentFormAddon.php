<?php

namespace FF_Addon;
use FF_Addon\DatePickerField;
use FF_Addon\MultiSelectDate;

class FluentFormAddon {

    public function __construct() {
        $this->load_dependencies();
        $this->register_fields();
    }

    public function load_dependencies() {
        require_once FFA_DIR_PATH . 'includes/DatePickerField.php';
        require_once FFA_DIR_PATH . 'includes/MultiSelectDate.php';
        require_once FFA_DIR_PATH . 'includes/components/SelectDate.php';
        require_once FFA_DIR_PATH . 'includes/hooks/Filters.php';
        require_once FFA_DIR_PATH . 'includes/form/FormDataParser.php';
    }

    public function register_fields() {
        new DatePickerField();
        new MultiSelectDate();
    }
}
