<?php
/* 

Create tables in the database

SQL Syntax: postgreSQL
*/


// TODO allow only logged in db admin

header("Content-type: application/json");

class createTablesAPI extends GenericAPI {

    public function __construct() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                if (preg_match('/api\/createTables\/(([0-9,a-z,A-Z,-])+)(\/)?$/', $_SERVER['REQUEST_URI'], $matches)) {
                    echo "{response: 'API GET'}";
                } else {
                    http_response_code(400);
                    echo '{"status":400, "response":"Bad request!"}';
                }
                break;
            case "POST":
                if (preg_match('/api\/createTables(\/)?$/', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> validateCreateTables();
                    
                } else {
                    http_response_code(400);
                    echo '{"status":400, "response":"Bad request!"}';
                    
                }
                break;
            default:
            http_response_code(400);
            echo '{"status":400, "response":"Bad request!"}';
        
        }
    }

    private function validateCreateTables() {
        // if user is authentificated (admin), then create tables in the database
        
                
        require_once __DIR__ . "/../models/genericModel.php";

        $this -> middlewares([['createTables', [$GLOBALS['db']]]]);
    }
}


class GenericAPI {
    protected function middlewares($array) {
        for ($i = 0; $i < sizeof($array); $i++) {
            echo $array[$i][0];
            if (! $array[$i][0]($array[$i][1][0])) {
                break;
            }
        }
    }
    protected function adminOnly() {
        //TODO check if user is admin

        http_response_code(400);
        return true;
    }

    protected function volunteerOnly() {}

}