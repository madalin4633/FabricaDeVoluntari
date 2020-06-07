<?php

class AssociationModel
{
    public $volunteers = [];
    public $activity =[];
    public $personalDetails = [];
    public $pic = "no-photo.jpg";

    public function __construct()
    {
    }

    public function addTask($title, $desc, $obs, $max_volunteers, $duedate) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = "INSERT INTO tblTasks (assoc_id, title, descr, obs, max_volunteers, created_on, updated_on, due_date) 
            VALUES ($1,$2,$3, $4, $5, current_timestamp, current_timestamp, $6)";

            pg_send_prepare($conn, 'add_task', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $_SESSION['id'];
            $params[] = $title;
            $params[] = $desc;
            $params[] = $obs;
            $params[] = $max_volunteers;
            $params[] = $duedate;

            pg_send_execute($conn, 'add_task', $params);
            $result =  pg_get_result($conn);
            return pg_result_error($result);
        }
    }

    public function readActivity($assoc_id, $vol_id)
    {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = "SELECT 
            task_id,
            title,
            logo as assoclogo,
            descr,
            obs,
            due_date 
            FROM vAssociationActivity 
            WHERE assoc_id=$1 
            ORDER BY task_id ASC";
            // if (isset($vol_id)) {
            //     $query.= "AND vol_id=$2";
            // }

            pg_send_prepare($conn, 'get_activity', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $_SESSION['id']; // it was $assoc_id before merge
            if (isset($vol_id)) {
                $params[] = $vol_id;
            }
            pg_send_execute($conn, 'get_activity', $params);
            $result = pg_get_result($conn);
        }

        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $this -> activity[] = pg_fetch_assoc($result);
        }

        if (count($this->activity) == 0) return;
        
        // activity details
        if (!pg_connection_busy($conn)) {
            $query = "SELECT * 
            FROM vActivityEnrolledVolunteers 
            WHERE assoc_id=$1 AND done=false
            ORDER BY id ASC";

            pg_send_prepare($conn, 'get_activityDetails', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $_SESSION['id']; // it was $assoc_id before merge
            pg_send_execute($conn, 'get_activityDetails', $params);
            $resultDetails = pg_get_result($conn);
        }

        
        $act_row = 0;
        $this->activity[$act_row]['volunteers'] = [];
        
        if (count($this->activity) > 0)
        for ($xi = 0; $xi < pg_num_rows($resultDetails); $xi++) {
            $array = pg_fetch_assoc($resultDetails);
            $task_id = $array['id'];

            if (isset($this->activity[$act_row]['task_id']) && $this->activity[$act_row]['task_id'] != $task_id) {
                $act_row += 1;
            }
            $this->activity[$act_row]['volunteers'][] = $array;
        }
    
    }

    public function readPersonalDetails($assoc_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            pg_send_prepare($conn, 'get_personal_data', "SELECT  
                            nume as \"Nume\", 
                            reprezentant as \"Reprezentant\", 
                            nr_inreg as \"Nr. Inreg.\",
                            descriere as \"Descriere\",
                            adresa as \"Adresa\",
                            email as \"E-mail\", 
                            phone_no as \"Phone no.\", 
                            link_facebook as \"_ignore_facebook\", 
                            logo as \"_ignore_pic\",
                            TO_CHAR(data_infiintare, 'dd Mon YYYY') as \"_noedit_Data Infiintare\"  
                            FROM tblAssociations
            WHERE id = $1");

            $res = pg_get_result($conn);
        }
        
        if (!pg_connection_busy($conn)) {
            pg_send_execute($conn, 'get_personal_data', array($assoc_id));
            $result = pg_get_result($conn);
        }
            
        if (pg_num_rows($result) > 0) {
            $this -> personalDetails = pg_fetch_assoc($result);
            if ($this -> personalDetails['_ignore_pic']) 
                $this -> pic ='logo/' . $this -> personalDetails['_ignore_pic'];
        }
    }

    
    function get_nr_of_available_spots_on_task($task_id, $assoc_id){
        $db_conn = $GLOBALS['db'];

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_available_spots_on_task', 'SELECT max_volunteers FROM tbltasks WHERE id =' . $task_id);
    
            $res = pg_get_result($db_conn);
        }
          
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_available_spots_on_task', array());
            $result = pg_get_result($db_conn);
        }
    
        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
    
        $max_spots = $row['max_volunteers'];

        $query = 'SELECT COUNT(*) as result FROM vvolunteeractivity WHERE task_id = ' . $task_id . ' AND assoc_id = '.$assoc_id;

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_nr_of_vol_on_task', $query);
    
            $res = pg_get_result($db_conn);
        }
          
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_nr_of_vol_on_task', array());
            $result = pg_get_result($db_conn);
        }
    
        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);

        $ocuppied_spots = $row['result'];

        return $max_spots - $ocuppied_spots;
    }

    function enable_recruitments($association_id){

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        // $invitation_code = hash('sha256', $randomString);
        $invitation_code = $_SERVER['HTTP_ORIGIN'] . '/user/joinAssociation/' . $randomString;

        $db_conn = $GLOBALS['db'];

        $query = 'UPDATE tblassociations SET link_invitatie_activ = true, link_invitatie = ' . pg_escape_literal($invitation_code) . ' WHERE id = ' . $association_id;

        // print_r($query);

        if(!pg_connection_busy($db_conn)){
            pg_send_prepare($db_conn, 'enable_recruitments', $query);
    
            $res = pg_get_result($db_conn);
        }

        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'enable_recruitments', array());
            $result = pg_get_result($db_conn);
        }

        $cmdtuples = pg_affected_rows($result);

        if (!$cmdtuples){
            return false;
        }

        return $invitation_code;
    }

    function disable_recruitments($association_id){
        $db_conn = $GLOBALS['db'];

        $query = 'UPDATE tblassociations SET link_invitatie_activ = false' . ' WHERE id = ' . $association_id;

        // print_r($query);

        if(!pg_connection_busy($db_conn)){
            pg_send_prepare($db_conn, 'disable_recruitments', $query);
    
            $res = pg_get_result($db_conn);
        }

        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'disable_recruitments', array());
            $result = pg_get_result($db_conn);
        }

        $cmdtuples = pg_affected_rows($result);

        if (!$cmdtuples){
            return false;
        }

        return true;
    }

    function get_invite_link($association_id){
        $db_conn = $GLOBALS['db'];

        $query = 'SELECT link_invitatie_activ, link_invitatie from tblassociations WHERE id = ' . $association_id;

        if(!pg_connection_busy($db_conn)){
            pg_send_prepare($db_conn, 'get_invite_link', $query);
    
            $res = pg_get_result($db_conn);
        }

        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_invite_link', array());
            $result = pg_get_result($db_conn);
        }

        $row = pg_fetch_array($result);

        if ($row){
            if($row['link_invitatie_activ'] == "t"){
                return $row['link_invitatie'];
            }
        }
        return false;
    }

    function get_association_id_by_invite_link($invite_link){
        $db_conn = $GLOBALS['db'];

        $query = 'SELECT id, link_invitatie_activ from tblassociations WHERE link_invitatie = ' . pg_escape_literal($invite_link);

        if(!pg_connection_busy($db_conn)){
            pg_send_prepare($db_conn, 'get_assoc_id_by_invite_link', $query);
    
            $res = pg_get_result($db_conn);
        }

        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_assoc_id_by_invite_link', array());
            $result = pg_get_result($db_conn);
        }

        $row = pg_fetch_array($result);

        if ($row){
            if($row['link_invitatie_activ'] == "t"){
                return $row['id'];
            }
        }
        return false;
    }

}
