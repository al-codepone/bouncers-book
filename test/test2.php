<?php

require 'vendor/autoload.php';
 
$validator = new silver\validator\Validator2();
 
if(list($input_values, $errors) = $validator->validate()) {
    $content = $errors
        ? form2($input_values, $errors)
        : c\pre(print_r($input_values, true));
}
else {
    $content = form2($validator->values());
    $autofocus = c\focus('input1');
}
 
include 'src/silver/html/template.php';
