<?php

ini_set('display_errors', 1);
ini_set('displcourse_get_dateay_startup_errors', 1);
error_reporting(1);

if (!session_id()) @session_start();

require_once __DIR__."/../vendor/autoload.php";

$flash = new \Plasticbrain\FlashMessages\FlashMessages();
