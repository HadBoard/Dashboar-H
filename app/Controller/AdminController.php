<?php

namespace App\Controller;


class AdminController extends Controller {

    public function login() {

        if (! request('login')) return;

        $rules = [
            'email' => 'require|email',
            'password' => 'require'
        ];

        if (! $this->validation(request()->all(), $rules)) return;


    }

}