<?php

namespace App\Helper;

class Validation
{

    private $errors;
    private $data;

    public function make(array $data, array $rules)
    {
        $valid = true;
        $this->data = $data;

        foreach ($rules as $item => $rulest) {
            $rulest = explode('|', $rulest);
            foreach ($rulest as $rule) {
                $pos = strpos($rule, ':');

                if ($pos !== false) {
                    $parametr = substr($rule, $pos+1);
                    $rule = substr($rule, 0, $pos);
                } else {
                    $parametr = "";
                }

                $MethodName = ucfirst($rule);

                $value = $data[$item] ?? null;

                if(method_exists($this,$MethodName)) {
                    if($this->{$MethodName}($item,$value,$parametr) == false) {
                        $valid = false;
                    }
                }

            }
        }

        return $valid;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function require($item, $value)
    {
        if (strlen($value == 0) || $value == null) {
            $this->errors[$item][] = "پر کردن فیلد {$item} الزامی میباشد .";
            var_dump($value);
            return false;
        }
        return true;
    }

    private function email($item, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$item][] = "فرمت پست الکترونیکی وارد شده صحیح نمیباشد .";
            return false;
        }
        return true;
    }

    private function min($item, $value, $param)
    {
        if (strlen($value < $param)) {
            $this->errors[$item][] = "طول فیلد {$item} باید بیشتر از {$param} کاراکتر باشد .";
            return false;
        }
        return true;
    }

    private function max($item, $value, $param)
    {
        if (strlen($value > $param)) {
            $this->errors[$item][] = "طول فیلد {$item} باید کمتر از {$param} کاراکتر باشد .";
            return false;
        }
        return true;
    }

    private function confirm($item, $value, $param)
    {
        $orginal = isset($this->data[$item]) ? $this->data[$item] : null;
        $confirm = isset($this->data[$item]) ? $this->data[$param] : null;
        if ($orginal != $confirm){
            $this->errors[$item][] = "فیلد {$item} با فیلد {$param} برابر نمیباشد !";
            return false;
        }
        return true;
    }

}