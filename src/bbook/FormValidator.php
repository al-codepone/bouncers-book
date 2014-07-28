<?php

namespace bbook;

abstract class FormValidator {
    private $inputs;
    private $optional_inputs;
    private $submitted_inputs;

    public function __construct(
        array $inputs = array(),
        array $optional_inputs = array(),
        array $submitted_inputs = null)
    {
        $this->inputs = $this->normalize_inputs($inputs);
        $this->optional_inputs = $optional_inputs;
        $this->submitted_inputs = is_null($submitted_inputs)
            ? $_POST
            : $submitted_inputs;
    }

    public function values() {
        return $this->inputs;
    }

    public function validate() {
        if($this->is_ready()) {
            $values = array();
            $errors = array();

            foreach(array_keys($this->inputs) as $key) {
                $value = isset($this->submitted_inputs[$key])
                    ? $this->submitted_inputs[$key]
                    : $this->inputs[$key];

                $method_name = "validate_$key";
                $values[$key] = $value;
                $error = method_exists($this, $method_name)
                    ? $this->$method_name($value)
                    : null;

                if(!is_null($error)) {
                    $errors[$key] = $error;
                }
            }

            if(method_exists($this, 'more')) {
                $more_errors = $this->more($values);

                if(!is_null($more_errors)) {
                    $errors = array_merge($errors,
                        is_array($more_errors) ? $more_errors : array($more_errors));
                }
            }

            return array($values, $errors);
        }
    }

    protected function add_inputs(array $inputs) {
        $this->inputs = array_merge($this->inputs, $this->normalize_inputs($inputs));
    }

    protected function add_optional_inputs(array $inputs) {
        $this->optional_inputs = array_merge($this->optional_inputs, $inputs);
    }

    private function is_ready() {
        foreach(array_keys($this->inputs) as $key) {
            if(!isset($this->submitted_inputs[$key])
                && !in_array($key, $this->optional_inputs))
            {
                return false;
            }
        }

        return true;
    }

    private function normalize_inputs(array $inputs) {
        $normalized_inputs = array();
        
        foreach($inputs as $i => $v) {
            if(is_int($i)) {
                $normalized_inputs[$v] = '';
            }
            else {
                $normalized_inputs[$i] = $v;
            }
        }

        return $normalized_inputs;
    }
}
