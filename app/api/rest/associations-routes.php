<?php

class Response {
    static function status($code) {
        http_response_code($code);
    }

    static function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

$associationsRoutes = [
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "associations/:id",
        "handler" => "getAssociations"
    ],   
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "associations/:id/volunteers",
        "handler" => "getVolunteers"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "associations/:id/volunteers/:id",
        "handler" => "getVolunteersActivity"
    ],
];
//de terminat de adaugat toate rutele... inclusiv de post, etc.

function IsLoggedIn()
{
    $allHeaders = getallheaders();

    if (isset($allHeaders['Authorization'])) {
        return true;
    }

    Response::status(401);
    Response::json([
        "status" => 401,
        "reason" => "You can only access this route if you're authenticated!"
    ]);

    return false;
}

function IsPartOfTeam($req)
{
    if ($req['params']['teamId'] === 'uaic') {
        return true;
    }

    Response::status(403);
    Response::json([
        "status" => 403,
        "reason" => "You can only access this teams you're part of!"
    ]);

    return false;
}


function getAssociations($req) {
    Response::status(200);
    echo "GET ALL TEAMS" . $req['payload'];
    //un select din baza de date cu asociatii
}

function getVolunteers($req) {
    Response::status(200);
    echo "GET ALL VOLUTNEERS from a specific association." . $req['payload'];
    //un select din baza de date cu voluntari, avand where la asociatie setat.
}

function getVolunteersActivity($req){
    // de luat activitatea din bd si pus aici
}

function getTeam($req) {


    // req['payload']

    // DB GET $req['params']['teamId'];

    Response::status(200);
    Response::json($req['params']);
    
    
    
    // echo "Get team {$req['params']['teamId']}";
    // $req['params']['teamId'];


    /// procesare din DB

    // $res -> status(200); 
        // http_response_code(200)
    
    // $res -> json($payload);
        // header("Content-Type: application/json");
        // echo json_encode($payload);
}

function addTeam($req) {
    $modifiedPayload = $req['payload'];
    $modifiedPayload -> id = uniqid();
    
    Response::status(200);
    Response::json($modifiedPayload);
}


