<?php

// store http://domain
$GLOBALS['URL_HOST'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'];

// store user id globally
$GLOBALS['user_id'] = "4";
