<?php

namespace silver\validator;

class Validator1 extends \bbook\FormValidator {
    public function __construct() {
        parent::__construct(array(
            'input1',
            'input2'));
    }

    protected function validate_input1($value) {
        if(!preg_match('/^[a-z0-9]{1,10}$/i', $value)) {
            return 'Input 1 must be 1-10 characters; letters and numbers only';
        }
    }
 
    protected function validate_input2($value) {
        if(strlen($value) < 6) {
            return 'Input 2 must be 6 or more characters';
        }
    }
}
