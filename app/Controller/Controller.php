<?php

namespace App\Controller;

use App\Helper\Validation;

class Controller
{

    public $flash;

    public function __construct()
    {
        $this->flash = "";
    }

    public function validation($data, $rules){

        $validation = new Validation();

        $valid = $validation->make($data, $rules);

        if (! $valid) {

            
            var_dump($validation->getErrors());
        }

        return true;
    }

}