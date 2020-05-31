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
        "handler" => "addVolunteer"   //DE FACUT 
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
        "handler" => "updateVolunteer"  //DE FACUT 
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
        "handler" => "removeVolunteerFromAssoc" //DE VERIFICAT
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "volunteers/:voluntId/associations/:assocId/tasks",
        "handler" => "getVolunteerTasks"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
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
        "handler" => "giveTaskFeedback"  //DE FACUT
    ]
];

function IsLoggedIn()
{
    $allHeaders = getallheaders();

    if(isset($_SESSION['user_id'])){
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

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_all_volunteers());
    
}

function getVolunteer($req) {

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_by_id($req['params']['voluntId']));

}

function updateVolunteer($req){
    // de updatat info despre voluntar
}

function deleteVolunteer($req){

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->delete_volunteer_by_id($req['params']['voluntId']));

}

function getVoluntAssociations($req){

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_associations_of_volunteer_by_id($req['params']['voluntId']));
}

function getAssocActivity($req){

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_activity_from_association($req['params']['voluntId'], $req['params']['assocId']));
    
}

function removeVolunteerFromAssoc($req){   //  DE VERIFICAAAAAAAAAAAAT

    // "volunteers/:voluntId/associations/:assocId"

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    print_r(req['params']['voluntId'].'  ');

    print_r(req['params']['assocId'].'  ');
    Response::status(200);
    Response::json($volunteer->remove_volunteer_from_association($req['params']['voluntId'], $req['params']['assocId']));

}

function getVolunteerTasks($req){
    //ia din task-urile voluntarului in acea asociatie -- 

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_tasks_from_association($req['params']['voluntId'], $req['params']['assocId']));
}

function getAssocTask($req){
    //ia un task dintr-o asociatie

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_task_by_id_from_association($req['params']['voluntId'], $req['params']['assocId'], $req['params']['taskId']));

}

function getVolunteerAllTasks($req){
    //toate task-urile unui singur voluntar pe toate asociatiile
    
    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_all_tasks($req['params']['voluntId']));

}

function getVolunteerTask($req){
    //ia task-ul unui voluntar
    
    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_task_by_id($req['params']['voluntId'], $req['params']['taskId']));

}

function getFeedback($req){
    //primeste feedback-urile primite de voluntar/eventual si cele trimise

    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_review_by_id($req['params']['voluntId']));

}

function getTaskFeedback($req){
    //primeste feedback-ul pe un task anume
    require_once __DIR__ . "/../../models/volunteerModel.php";

    $volunteer = new volunteerModel();

    Response::status(200);
    Response::json($volunteer->get_volunteer_review_specific_task($req['params']['voluntId'], $req['params']['taskId']));

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
