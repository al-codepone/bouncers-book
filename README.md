# Bouncer's Book

Bouncer's Book is a PHP form validator.

## Documentation

This [README](https://github.com/al-codepone/bouncers-book/blob/master/README.md)
is currently the only documentation.

## Requirements

**PHP 5.3** or higher and [Composer](https://getcomposer.org/).
The [tests](https://github.com/al-codepone/bouncers-book/tree/master/test)
require [Corn Wand](https://github.com/al-codepone/corn-wand).


## Source Code

The [project](https://github.com/al-codepone/bouncers-book) is on GitHub.
The source code is [one class](https://github.com/al-codepone/bouncers-book/blob/master/src/bbook/FormValidator.php).

## Tests

All the tests are in the [test directory](https://github.com/al-codepone/bouncers-book/tree/master/test).
Each PHP script in the top level test directory is a separate test.
You need to run `composer install` in the test directory before running any of the tests.
Tests 1-3 test the first, second and third constructor parameters respectively.
Test 4 tests the `more()` method.

## Installation

Install using composer:

```javascript
{
    "require": {
        "bouncers-book/bouncers-book": "0.5.0",
    }
}
```

## Basic Usage

Set up a form validator class:

```php
namespace silver\validator;

class Validator1 extends \bbook\FormValidator {
    public function __construct() {

        //list all the form inputs
        parent::__construct(array(
            'input1',
            'input2'));
    }

    //validate form inputs with validate_ methods
    //return null if valid
    protected function validate_input1($value) {
        if(!preg_match('/^[a-z0-9]{1,10}$/i', $value)) {
            return 'Input 1 must be 1-10 characters; letters and numbers only';
        }
    }

    //validate method for input2
    protected function validate_input2($value) {
        if(strlen($value) < 6) {
            return 'Input 2 must be 6 or more characters';
        }
    }
}
```

Validate `$_POST` with `validate()`:

```php
require 'vendor/autoload.php';

$validator = new silver\validator\Validator1();

if(list($input_values, $errors) = $validator->validate()) {
    $content = $errors

        //re-display form if there is an error
        ? form1($input_values, $errors)

        //no errors, process form data
        : c\pre(print_r($input_values, true));
}
else {

    //form not submitted, first time user arrives at website
    $content = form1($validator->values());
    $autofocus = c\focus('input1');
}

include 'src/silver/html/template.php';
```

## Optional Inputs

Use the second constructor parameter to specify which submitted inputs are optional:

```php
namespace silver\validator;

class Validator2 extends \bbook\FormValidator {
    public function __construct() {
        parent::__construct(

            //list form inputs and default values
            array(
                'input1',
                'pizzas' => array()),

            //list optional inputs, pizzas is checkboxes
            array('pizzas'));
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
```

## Validate Any Data

Use the third constructor parameter to specify the data to validate:

```php
namespace silver\validator;

class Validator3 extends \bbook\FormValidator {
    public function __construct() {
        parent::__construct(

            //list form inputs
            array(
                'input1',
                'input2'),

            //which are optional? none
            array(),

            //validate this data instead of $_POST
            array(
                'input1' => 'Fred?',
                'input2' => '123456'));
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
```

## Validate More

Use `more()` to validate more than one value at a time:

```php
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
```

## LICENSE

MIT <http://ryf.mit-license.org/>
