<?php
/* 

Create tables in the database

SQL Syntax: postgreSQL
*/

// TODO allow only logged in db admin

header("Content-type: application/json");

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        if (preg_match('/api\/createTables\/(([0-9,a-z,A-Z,-])+)(\/)?$/', $_SERVER['REQUEST_URI'], $matches)) {
            echo "{response: 'API GET'}";
        } else {
            echo "{status:400, response:'Bad request!'}";
        }
        break;
    case "POST":
        if (preg_match('/api\/createTables(\/)?$/', $_SERVER['REQUEST_URI'], $matches)) {
            // if user is authentificated (admin), then create tables in the database
            echo "{response: 'API received create tables'}";

            require_once __DIR__ . "/../models/genericModel.php";
            createTables($GLOBALS['db']);
            
        } else {
            echo "{status:400, response:'Bad request!'}";
        }
        break;
    default:
        echo "{status:400, response:'Bad request!'}";

}


