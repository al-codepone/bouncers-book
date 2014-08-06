<?php

require 'vendor/autoload.php';
 
$validator = new silver\validator\Validator3();

if(list($input_values, $errors) = $validator->validate()) {
    $content = $errors
        ? form1($input_values, $errors)
        : c\pre(print_r($input_values, true));
}
else {
    $content = form1($validator->values());
    $autofocus = c\focus('input1');
}
 
include 'src/silver/html/template.php';
