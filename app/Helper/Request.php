<?php

namespace App\Helper;

class Request
{

    public function input($field, $post = true)
    {
        if ($this->isPost() && $post)
            return isset($_POST[$field]) ? $this->cleaner($_POST[$field]) : null;
        return isset($_GET[$field]) ? $this->cleaner($_GET[$field]) : null;
    }

    public function all($post = true)
    {
        if ($this->isPost() && $post)
            return isset($_POST) ? array_map('htmlspecialchars', $_POST) : null;
        return isset($_GET) ? array_map('htmlspecialchars', $_GET) : null;
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function cleaner($field)
    {

        if ($field) {
            $field = htmlspecialchars($field);
            $field = strip_tags($field);
        }
        $field = stripslashes($field);
//        $field = mysqli_real_escape_string($this->connection, $field);
        $field = $this->convertNumbers($field);
        return $field;

    }

    public function convertNumbers($input)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
        $english = [0, 1, 2, 3, 4, 4, 5, 5, 6, 6, 7, 8, 9];
        foreach ($persian as $p) {
            if (stripos($input, $p) > 0) return str_replace($persian, $english, $input);
        }
        return $input;
    }

}