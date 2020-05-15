<?php

// user notifications
$GLOBALS['user-notifications'] = new Notifications();

// store http://domain
$GLOBALS['user-notifications']->addNotification( "<p>https on: " . (isset($_SERVER['HTTPS']) ? "yes" : "no") . " | " . isset($_SERVER['HTTPS']) . "</p>");

// store user id globally
$GLOBALS['user_id'] = "4";

