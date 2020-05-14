<?php

require_once "./associations-routes.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$allHeaders = getallheaders();

$allRoutes = [
    ...$ngosRoutes, 
    //... sparg cumva elementele din ngosRouteas
    //...$volunteerRoutes daca vreau si elementele alea
];
  
foreach($allRoutes as $routeConfig) {
    if(parseRequest($routeConfig)){
        exit; //prima match-uita, trece
    }
}

handle404();

function parseRequest($routeConfig){
//regexp match
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    if($method !== $routeConfig['method']) {
        return false;
    }

    $regExpString = "";

    $parts = explode('/', $routeConfig['route']); 

    foreach($parts as $p) {
        if($p[0]===':') {
            $regExpString = '([a-zA-Z0-9]+)';
        }
        else {
            $regExpString = $p;
        }

        $regExpString = '/';
    }
    $regExpString = '$';

    echo 'merge ma';
}

function handle404() {

}

switch($_SERVER['REQUEST_METHOD']) {
    case "GET":
        echo "GET to rest service";
        break;
    case "POST":
        $body=file_get_contents("php://input");
        echo "Post to rest service:" . $body;
        break;
    default:
        break;
}