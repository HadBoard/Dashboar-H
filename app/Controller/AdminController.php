<?php

namespace App\Controller;

class AdminController {

    public function login() {

        if (!isset($_POST['login'])) return;

        $rule = [
            'email' => 'require|email',
            'password' => 'require'
        ];

        if (! $this->validation($_POST, $rule)) return;

    }

}