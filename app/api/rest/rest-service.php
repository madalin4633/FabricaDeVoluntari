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

    if(strpos($url,'?')!=FALSE)
        $regExpString = $this -> routeExpToRegExp($routeConfig['route'], 1);
    else 
        $regExpString = $this -> routeExpToRegExp($routeConfig['route'], 0);

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



function routeExpToRegExp($route, $withQuery)
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
    if($withQuery==0)
        $regExpString .= '$'; //end of string
    else $regExpString .= '\?([\w-]+(=[\w-]*)?(&[\w-]+(=[\w-]*)?)*)?$';
    //print_r($regExpString);

    return $regExpString;
}

}