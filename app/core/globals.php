<?php

// user notifications
$GLOBALS['user-notifications'] = new Notifications();

// store http://domain
$GLOBALS['URL_HOST'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
$GLOBALS['user-notifications']->addNotification( "<p>https on: " . (isset($_SERVER['HTTPS']) ? "yes" : "no") . " | " . isset($_SERVER['HTTPS']) . "</p>");

// store user id globally
$GLOBALS['user_id'] = "4";

