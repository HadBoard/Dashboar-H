<?php

function old($field)
{
    return request($field);
}

function request($field = null)
{
    $request = new \App\Helper\Request();
    if (is_null($field))
        return $request;
    return $request->input($field);
}
