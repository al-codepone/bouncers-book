<?php

namespace silver\validator;

class Validator2 extends \bbook\FormValidator {
    public function __construct() {
        parent::__construct(
            array(
                'input1',
                'pizzas' => array()),
            array(
                'pizzas'));
    }

    protected function validate_input1($value) {
        if(!preg_match('/^[a-z0-9]{1,10}$/i', $value)) {
            return 'Input 1 must be 1-10 characters; letters and numbers only';
        }
    }
 
    protected function validate_pizzas($value) {
        if(count($value) != 2) {
            return 'Choose 2 types of pizza';
        }
    }
}
