<?php

// user notifications
$GLOBALS['user-notifications'] = new Notifications();

// store http://domain
$GLOBALS['user-notifications']->addNotification( "<a href='https://validator.w3.org/nu/?showsource=yes&doc=https%3A%2F%2Ffabrica-de-voluntari.herokuapp.com" . urlencode($_SERVER['REQUEST_URI']) . "' target='_blank' rel='noopener'>Validate my page </a>
    <a href='https://web.dev/measure/' target='_blank' rel='noopener'>Measure my site </a>
    <p>https://fabrica-de-voluntari.herokuapp.com/</p>" );

// store user id globally
$GLOBALS['user_id'] = "11";

