<?php
/*

Create tables in the database
SQL Syntax: postgreSQL
*/

// TODO allow only logged in db admin

require_once __DIR__ . '/genericAPI.php';
header("Content-type: application/json");

class createTablesAPI extends GenericAPI
{
    public function __construct()
    {
        require_once __DIR__ . "/../models/genericModel.php";

        switch ($_SERVER['REQUEST_METHOD']) {
            case "DELETE":
                // api/createTables/Associations
                if (preg_match('/api\/createTables\/Associations(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['dropTableAssociations', [$GLOBALS['db']]]]);
                
                // api/createTables/Volunteers
                } elseif (preg_match('/api\/createTables\/Volunteers(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['dropTableVolunteers', [$GLOBALS['db']]]]);
                        
                // api/createTables/VolAssoc
                } elseif (preg_match('/api\/createTables\/VolAssoc(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['dropTableVolAssoc', [$GLOBALS['db']]]]);

                // api/createTables/Feedback
                } elseif (preg_match('/api\/createTables\/Feedback(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['dropTableFeedback', [$GLOBALS['db']]]]);
                } else {
                    http_response_code(400);
                    echo '{"status":400, "response":"Bad request!"}';
                }
                break;
                case "PUT":
                    // api/createTables/Associations
                    if (preg_match('/api\/createTables\/Associations(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                        $this -> middlewares([['insertDataAssociations', [$GLOBALS['db']]]]);
                    
                    // api/createTables/Volunteers
                    } elseif (preg_match('/api\/createTables\/Volunteers(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                        $this -> middlewares([['insertDataVolunteers', [$GLOBALS['db']]]]);
                            
                    // api/createTables/VolAssoc
                    } elseif (preg_match('/api\/createTables\/VolAssoc(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                        $this -> middlewares([['insertDataVolAssoc', [$GLOBALS['db']]]]);

                     // api/createTables/Feedback
                    } elseif (preg_match('/api\/createTables\/Feedback(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                        $this -> middlewares([['insertDataFeedback', [$GLOBALS['db']]]]);
                        
                     // api/createTables
                    } elseif (preg_match('/api\/createTables(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                        $this -> middlewares([['insertDataAll', [$GLOBALS['db']]]]);
                        
                    } else {
                        http_response_code(400);
                        echo '{"status":400, "response":"Bad request!"}';
                    }
                    break;
                case "POST":
                // api/createTables/Associations
                if (preg_match('/api\/createTables\/Associations(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['createTableAssociations', [$GLOBALS['db']]]]);
                
                // api/createTables/Volunteers
                } elseif (preg_match('/api\/createTables\/Volunteers(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['createTableVolunteers', [$GLOBALS['db']]]]);
                        
                // api/createTables/VolAssoc
                } elseif (preg_match('/api\/createTables\/VolAssoc(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['createTableVolAssoc', [$GLOBALS['db']]]]);
                        
                // api/createTables/Feedback
                } elseif (preg_match('/api\/createTables\/Feedback(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                $this -> middlewares([['createTableFeedback', [$GLOBALS['db']]]]);
                    
                // api/createTables
                } elseif (preg_match('/api\/createTables(\/)?$/i', $_SERVER['REQUEST_URI'], $matches)) {
                    $this -> middlewares([['createTables', [$GLOBALS['db']]]]);
                    
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

    private function validateCreateTables()
    {
        // if user is authentificated (admin), then create tables in the database
        
                
        require_once __DIR__ . "/../models/genericModel.php";

        $this -> middlewares([['createTables', [$GLOBALS['db']]]]);
    }
}
