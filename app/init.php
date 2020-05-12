<?php


// include core dependencies
require_once 'core/globals.php';

if (strpos($_SERVER['REQUEST_URI'], 'fabricadevoluntari') !== false)
    $GLOBALS['URL_HOST'] .= '/fabricadevoluntari';
    
require_once 'core/database.php';
require_once 'core/App.php';

?>