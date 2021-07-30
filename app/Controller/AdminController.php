<?php

namespace App\Controller;


class AdminController extends Controller {

    public function login() {

        if (!isset($_POST['login'])) return;

        $rules = [
            'email' => 'require|email',
            'password' => 'require'
        ];

        $valid = $this->validation($_POST, $rules);


    }

}