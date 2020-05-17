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

$volunteersRoutes = [
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers",
        "handler" => "getVolunteers"
    ],
    [
        "method" => "POST",
        //"middlewares" => ["IsLoggedIn"] --abia iti faci cont de voluntar, nu tre sa fii logat
        "route" => "volunteers",
        "handler" => "addVolunteer"
    ],   
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId",
        "handler" => "getVolunteer"
    ],
    [
        "method" => "PUT",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId",
        "handler" => "updateVolunteer"
    ],
    [
        "method" => "DELETE",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId",
        "handler" => "deleteVolunteer"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/associations",
        "handler" => "getVoluntAssociations"
    ],   
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/associations/:assocId",
        "handler" => "getAssocActivity"
    ],
    [
        "method" => "DELETE",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/associations/:assocId",
        "handler" => "removeVolunteerFromAssoc"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn", "IsPartOfAssociation"],
        "route" => "volunteers/:voluntId/associations/:assocId/tasks",
        "handler" => "getVolunteerTasks"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn", "IsPartOfAssociation"],
        "route" => "volunteers/:voluntId/associations/:assocId/tasks/:taskId",
        "handler" => "getAssocTask"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/tasks",
        "handler" => "getVolunteerAllTasks"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/tasks/:taskId",
        "handler" => "getVolunteerTask"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/ratings",
        "handler" => "getFeedback"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/tasks/:taskId/ratings",
        "handler" => "getTaskFeedback"
    ],
    [
        "method" => "POST",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/tasks/:taskId/ratings",
        "handler" => "giveTaskFeedback"
    ]
];

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

function IsPartOfAssociation($req) //middleware de verificare daca e in asociatie
{
    if ($req['params']['assocId'] === 'moldavia') {
        return true;
    }

    Response::status(403);
    Response::json([
        "status" => 403,
        "reason" => "You can only access this teams you're part of!"
    ]);

    return false;
}


function getVolunteers($req) {
    Response::status(200);
    echo "GET ALL TEAMS" . $req['payload'];
    //un select din baza de date cu asociatii
}

function getVolunteer($req) {
    Response::status(200);
    echo "GET A VOLUTNEER from a specific association." . $req['payload'];
    //un select din baza de date cu voluntari, avand where la asociatie setat.
}

function updateVolunteer($req){
    // de updatat info despre voluntar
}

function deleteVolunteer($req){
    //sterge contul de voluntar practic
}

function getVoluntAssociations($req){
    //asociatiile unui voluntar
}

function getAssocActivity($req){
    //activitatea unui voluntar dintr-o asociatie
}

function removeVolunteerFromAssoc($req){
    //sterge un voluntar dintr-o asociatie
}

function getVolunteerTasks($req){
    //ia din task-urile voluntarului in acea asociatie -- 
}

function getAssocTask($req){
    //ia un task dintr-o asociatie
}

function getVolunteerAllTasks($req){
    //toate task-urile unui singur voluntar pe toate asociatiile
}

function getVolunteerTask($req){
    //ia task-ul unui voluntar
}

function getFeedback($req){
    //primeste feedback-urile primite de voluntar/eventual si cele trimise
}

function getTaskFeedback($req){
    //primeste feedback-ul pe un task anume
}

function giveTaskFeedback($req){
    //da feedback pentru un task anume
}


//mai jos exemple din cod - functii folosite la rutele din exemplele de pe devdrive.
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


function addVolunteer($req) {
    $modifiedPayload = $req['payload'];
    $modifiedPayload -> id = uniqid();
    
    Response::status(200);
    Response::json($modifiedPayload);
}


