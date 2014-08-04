<?php

function form1(array $input_values, $errors = array()) {
    return c\form(
        array('method' => 'post'),
        c\ulist($errors, array('style' => 'color:red')),
        c\dlinput(
            'Input 1',
            array(
                'id' => 'input1',
                'value' => $input_values['input1'])),

        c\dlinput(
            'Input 2',
            array(
                'id' => 'input2',
                'value' => $input_values['input2'])),

        c\div('<input type="submit" value="Submit"/>'));
}
