<?php

$associationsRoutes = [
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations",
        "handler" => "getAssociations"
    ],
    [
        "method" => "POST",
        //"middlewares" => ["IsLoggedInHere"] -- abia iti faci cont de asociatie, nu tre sa fii logat
        "route" => "associations",
        "handler" => "addAssociation"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId",
        "handler" => "getAssociation"
    ],
    [
        "method" => "DELETE",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId",
        "handler" => "deleteAssociation"
    ],
    [
        "method" => "PUT",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId",
        "handler" => "updateAssociation"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/myactivity",
        "handler" => "getMyActivity"
    ],   
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/volunteers",
        "handler" => "getVolunteersHere"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/volunteers/:voluntId",
        "handler" => "getVolunteersActivity"
    ],
    [
        "method" => "DELETE",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/volunteers/:voluntId",
        "handler" => "removeVolunteer"
    ],   
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/volunteers/:voluntId/tasks",
        "handler" => "getVolunteerTasksHere"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/volunteers/:voluntId/tasks/:taskId",
        "handler" => "getVolunteerTaskHere"
    ],
    [
        "method" => "PUT",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/volunteers/:voluntId/tasks/:taskId",
        "handler" => "doneVolunteerTaskHere"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/tasks",
        "handler" => "getAssocTasks"
    ],
    [
        "method" => "POST",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/tasks",
        "handler" => "AddTask"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/tasks/:taskId",
        "handler" => "getAssocTaskHere"
    ],
    [
        "method" => "PUT",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/tasks/:taskId",
        "handler" => "updateTask"
    ],
    [
        "method" => "DELETE",
        "middlewares" => ["IsLoggedInHere"],
        "route" => "associations/:assocId/tasks/:taskId",
        "handler" => "deleteTask"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "associations/:assocId/ratings",
        "handler" => "getFeedback"
    ],
    [
        "method" => "GET",
        "middlewares" => ["IsLoggedIn"],
        "route" => "associations/:assocId/tasks/:taskId/ratings",
        "handler" => "getTaskFeedback"
    ],
    [
        "method" => "POST",
        "middlewares" => ["IsLoggedIn"],
        "route" => "associations/:assocId/tasks/:taskId/ratings",
        "handler" => "giveTaskFeedback"
    ]
];
//de discutat daca metodele alese sunt ok

function IsLoggedInHere()
{
    $allHeaders = getallheaders();

    if($_SESSION['is_volunteer'] || $_SESSION['is_association']){
        return true;
    }
    //print_r('sunt aici');
    Response::status(401);
    Response::json([
        "status" => 401,
        "reason" => "You can only access this route if you're authenticated!"
    ]);

    return false;
}
function getMyActivity($req){
    require_once __DIR__ . "/../../models/associationModel.php";

    $association = new AssociationModel();
    Response::status(200);
    Response::json($association->get_myassociation_activity($req['params']['assocId'])); //returneaza rezultate diferite fata de select-ul facut in pgadmin
}
function updateAssociation($req) {
 //updateaza datele de la o asociatie
}

function deleteAssociation($req) {
    //sterge o asociatie din bd
}

function getAssociation($req) {
    //ia din bd doar o asociatie si da info despre ea
}
function getAssociations($req) {
    Response::status(200);
    echo "GET ALL TEAMS" . $req['payload'];
    //un select din baza de date cu asociatii - toate
}

function getVolunteersHere($req) {
    Response::status(200);
    echo "GET ALL VOLUTNEERS from a specific association." . $req['payload'];
    //un select din baza de date cu voluntari, avand where la asociatie setat.
}

function getVolunteersActivity($req){
    // de luat activitatea din bd si pus aici
}

function removeVolunteer($req){
    //de sters in tabela faptul ca e voluntar la aceasta asociatie.
}

function getVolunteerTasksHere($req){
    //ia task-urile unui voluntar si le pune pe ecran
}

function getVolunteerTaskHere($req){
    //ia din task-urile voluntarului doar un task anume
}

function doneVolunteerTaskHere($req) {
    //poate modifica task, inclusiv sa il bifeze ca facut !!!!!!!! NUMAI DACA E TASK_UL DIN ACEA ASOCIATIE
}

function getAssocTasks($req){
    //ia toate task-urile dintr-o asociatie
}

function addTask($req){
    //add task in asociatie - fiecare voluntar si-l poate prelua
}

function getAssocTaskHere($req){
    //ia un task al asociatiei
}

function updateTask($req){
    //da update la un task
}

function deleteTask($req){
    //da delete la un task
}


//mai jos exemple din cod - functii folosite la rutele din exemplele de pe devdrive.
function getTeamHere($req) {


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

function addAssociation($req) {
    $modifiedPayload = $req['payload'];
    $modifiedPayload -> id = uniqid();
    
    Response::status(200);
    Response::json($modifiedPayload);
}


