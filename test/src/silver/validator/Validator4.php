<?php

namespace silver\validator;

class Validator4 extends \bbook\FormValidator {
    public function __construct() {
        parent::__construct(array(
            'input1',
            'input2'));
    }

    protected function validate_input1($value) {
        if(trim($value) == '') {
            return 'Please enter a value for Input 1';
        }
    }
 
    protected function validate_input2($value) {
        if(trim($value) == '') {
            return 'Please enter a value for Input 2';
        }
    }

    protected function more($values) {
        if(trim($values['input1']) != '' &&
            trim($values['input2']) != '' &&
            $values['input1'] != $values['input2'])
        {
            return 'Input 1 and Input 2 must be the same';
        }
    }
}
