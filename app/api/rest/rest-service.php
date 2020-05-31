<?php

    header("Access-Control-Allow-Origin: *"); //pentru a evita CORS
    header("Access-Control-Allow-Headers: *");

class RestService{

public function __construct()
{   
    require_once __DIR__ . "/associations-routes.php";
    require_once __DIR__ . "/volunteers-routes.php";

    $allHeaders = getallheaders();

    $allRoutes = [
    ...$associationsRoutes,
    ...$volunteersRoutes
    ];

    foreach ($allRoutes as $routeConfig) {
       
        if ($this -> parseRequest($routeConfig)) {
            exit;
        }
    }
    require_once __DIR__ . "/createTables.api.php";
    $checkTableRoute = new CreateTablesApi();

    //handle404(); //included in createtablesapi, so it wont appear here
}

function myRoute(){
    return substr($_SERVER['REQUEST_URI'], -4, 0);
}

function parseRequest($routeConfig)
{
    // regexp match 
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method !== $routeConfig['method']) {
        return false;
    }

    $regExpString = $this -> routeExpToRegExp($routeConfig['route']);


    if (preg_match("/$regExpString/", $url, $matches)) {
        $params = [];
        $query = [];
        $parts = explode('/', $routeConfig['route']);

        // Params
        $index = 1;
        foreach ($parts as $p) {
            if ($p[0] === ':') {
                $params[substr($p, 1)] = $matches[$index];
                $index++;
            }
        }

        // Query
        if (strpos($url, '?')) {
            $queryString = explode('?', $url)[1];
            $queryParts = explode('&', $queryString);

            foreach ($queryParts as $part) {
                if (strpos($part, '=')) {
                    $query[explode('=', $part)[0]] = explode('=', $part)[1];
                }
            }
        }

        // Payload
        $payload = file_get_contents('php://input');
        if (strlen($payload)) {
            $payload = json_decode($payload);
        } else {
            $payload = NULL;
        }


        // if middlewares =>  run them first

        if (isset($routeConfig['middlewares'])) {
            foreach ($routeConfig['middlewares'] as $middlewareName) {
                $didPass = call_user_func($middlewareName, [
                    "params" => $params,
                    "query" => $query,
                    "payload" => $payload
                ]);

                if (!$didPass) {
                    exit();
                }
            }
        }

        call_user_func($routeConfig['handler'], [
            "params" => $params,
            "query" => $query,
            "payload" => $payload
        ]);

        return true;
    }

    return false;
}

function handle404()
{
    //Response::status(404);
}



function routeExpToRegExp($route)
{
    $regExpString = "\/api";
    $parts = explode('/', $route);

    foreach ($parts as $p) {
        $regExpString .= '\/'; //.= concatenare

        if ($p[0] === ':') {
            $regExpString .= '([a-zA-Z0-9]+)';
        } else {
            $regExpString .= $p;
        }
    }
    $regExpString .= '$';

    return $regExpString;
}

// if (
//     $_SERVER['REQUEST_METHOD'] !== 'OPTIONS' &&
//     $_SERVER['REQUEST_METHOD'] !== 'GET' &&
//     (!isset($allHeaders['Content-Type']) || $allHeaders['Content-Type'] !== 'application/json')
// ) {
//     header("Content-type: application/json");
//     http_response_code(400);
//     echo '{"status": 400, "reason": "Expecting payload as JSON" }';
//     exit;
// }



// switch ($_SERVER['REQUEST_METHOD']) {
//     case "GET":

//         echo "GET to rest service";
//         break;
//     case "POST":
//         header("Content-type: application/json");

//         $body = json_decode(file_get_contents("php://input"));
//         // insert
//         http_response_code(201);

//         $body->id = uniqid();
//         echo json_encode($body);

//         break;
//     default:
//         break;
// }

}