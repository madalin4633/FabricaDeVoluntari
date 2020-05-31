<?php

// user notifications
$GLOBALS['user-notifications'] = new Notifications();

// store http://domain
$GLOBALS['user-notifications']->addNotification("<div><a href='https://validator.w3.org/nu/?showsource=yes&doc=https%3A%2F%2Ffabrica-de-voluntari.herokuapp.com" . urlencode($_SERVER['REQUEST_URI']) . "' target='_blank' rel='noopener'>Validate my page </a>
    <a href='https://web.dev/measure/' target='_blank' rel='noopener'>Measure my site </a>
    <p>https://fabrica-de-voluntari.herokuapp.com/</p></div>");

// store user id globally
$GLOBALS['user_id'] = "4";

/**
 * insert html code for feedback stars
 */
function showFeedbackStars($rating)
{
    echo "<div class='nowrap ";
    if ($rating>0) {
        echo "svg-yellow";
    } else {
        echo "svg-grey";
    }
    echo " pack-tight'>
    ";
    for ($i = 0; $i < 5; $i++) {
        if (floor($rating) > $i) {
            echo "<img alt='icon' src='/public/images/star-24px.svg'>";
        } elseif (ceil($rating) > $i) {
            echo "<img alt='icon' src='/public/images/star_half-24px.svg'>";
        } else {
            echo "<img alt='icon' src='/public/images/star_border-24px.svg'>";
        }
    }

    echo "</div>";
}
