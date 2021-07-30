<?php

namespace App\Controller;

use App\Helper\Validation;

class AdminController {

    public function login() {

        if (!isset($_POST['login'])) return;

        $rules = [
            'email' => 'require|email',
            'password' => 'require'
        ];

        $validation = new Validation();
        $valid = $validation->make($_POST, $rules);

        if (! $valid) {
            var_dump($validation->getErrors());
        }

    }

}