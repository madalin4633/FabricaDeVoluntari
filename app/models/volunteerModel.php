<?php

class VolunteerModel {
    public $id;
    public $associations = [];
    public $suggestedAssociations = [];
    public $personalDetails = [];
    public $username = "_username_";
    public $pic = "no-photo.jpg";
    public $rating = 0;
    public $activity = [];
    public $newTasks = [];

    public function __construct()
    {
        $this -> id = $_SESSION['user_id'];

        // $this -> readAssociations($this->id);

        // $this -> readSuggestedAssociations($this->id);
        
        // $this -> readPersonalDetails($this->id);
    }

    public function readActivity($assoc_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = "SELECT 
            title,
            logo as assoclogo,
            descr,
            obs,
            due_date 
            FROM vVolunteerActivity 
            WHERE vol_id=$1 ";
            if (isset($assoc_id)) $query.= "AND assoc_id=$2";

            pg_send_prepare($conn, 'get_activity',  $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $GLOBALS['user_id'];
            if (isset($assoc_id)) $params[] = $assoc_id;
            pg_send_execute($conn, 'get_activity', $params);
            $result = pg_get_result($conn);
        }

        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $this -> activity[] = pg_fetch_assoc($result);
        }

        $this->readNewTasks($assoc_id);
    }

    public function readNewTasks($assoc_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = "SELECT 
            title,
            assoclogo,
            descr,
            obs,
            due_date 
            FROM vVolunteerNewTasks 
            WHERE vol_enrolled<max_volunteers ";
            if (isset($assoc_id)) $query.= "AND assoc_id=$1";

            pg_send_prepare($conn, 'get_newtasks',  $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            if (isset($assoc_id)) $params[] = $assoc_id;
            pg_send_execute($conn, 'get_newtasks', $params);
            $result = pg_get_result($conn);
        }

        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $this -> newTasks[] = pg_fetch_assoc($result);
        }
    }

    /**
     * retrieve personal data
     */
    function readPersonalDetails($vol_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            pg_send_prepare($conn, 'get_personal_data', "SELECT username as _ignore_username, 
                            nume as \"Nume\", 
                            prenume as \"Prenume\", 
                            gen as \"Gen\",
                            nationalitate as \"Nationalitate\",
                            email as \"E-mail\", 
                            profile_pic as \"_ignore_pic\",
                            TO_CHAR(data_nasterii, 'd Mon YYYY') as \"Data Nastere\",
                            TO_CHAR(created_on, 'Mon YYYY') as \"_noedit_Data Inscriere\"  
                            FROM tblVolunteers
            WHERE id = $1");

            $res = pg_get_result($conn);
        }
        
        if (!pg_connection_busy($conn)) {
            pg_send_execute($conn, 'get_personal_data', array($vol_id));
            $result = pg_get_result($conn);
        }
            
        if (pg_num_rows($result) > 0) {
            $this -> personalDetails = pg_fetch_assoc($result);
            $this -> username = $this -> personalDetails['_ignore_username'];
            if ($this -> personalDetails['_ignore_pic']) 
                $this -> pic = $this -> personalDetails['_ignore_pic'];
        }
    }

    function readAssociations($vol_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            pg_send_prepare($conn, 'get_associations', 'SELECT * FROM vVolunteerDashboard
            WHERE vol_id = $1');

            $res = pg_get_result($conn);
        }
        
        if (!pg_connection_busy($conn)) {
            pg_send_execute($conn, 'get_associations', array($vol_id));
            $result = pg_get_result($conn);
        }
            
        $rating = 0;
        $ratings = 0;
        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $assoc = pg_fetch_assoc($result);
            $this -> associations[] = $assoc;

            if ($assoc['rating']) {
                $rating += $assoc['rating'];
                $ratings++;
            }
            if ($ratings>0) $this->rating = $rating/$ratings;
        }
    }

    function readSuggestedAssociations($vol_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            pg_send_prepare($conn, 'get_suggested_associations', 'SELECT DISTINCT id, nume, logo 
            FROM tblAssociations 
            where id not in 
            (select distinct assoc_id from vvolunteerdashboard where vol_id = $1)
                ');

            $res = pg_get_result($conn);
        }
        
        if (!pg_connection_busy($conn)) {
            pg_send_execute($conn, 'get_suggested_associations', array($vol_id));
            $result = pg_get_result($conn);
        }
            
        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $assoc = pg_fetch_assoc($result);
            $this -> suggestedAssociations[] = $assoc;
        }
    }

    function get_volunteer_by_id($id) {
        
        $db_conn = $GLOBALS['db'];

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_volunteer', 'SELECT * FROM tblVolunteers WHERE id =' . $id);
    
            $res = pg_get_result($db_conn);
        }
          
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_volunteer', array());
            $result = pg_get_result($db_conn);
        }
    
        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
    
        pg_close();

        // $row = json_encode($row);
        return $row;
    }

    function get_all_volunteers() {
        $db_conn = $GLOBALS['db'];

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_volunteers', 'SELECT nume, prenume FROM tblVolunteers');

            $res = pg_get_result($db_conn);
        }
            
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_volunteers', array());
            $result = pg_get_result($db_conn);
        }

        $all_volunteers = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();

        // $all_volunteers = json_encode($all_volunteers);

        return $all_volunteers;
    }

    function update_volunteer_by_id($volunteer_id, $payload){
        
        $db_conn = $GLOBALS['db'];

        $query = 'UPDATE tblvolunteers SET nume = ' . pg_escape_literal($payload->nume) . ', prenume = ' . pg_escape_literal($payload->prenume) . ', username = ' . pg_escape_literal($payload->username) . ', data_nasterii = ' . pg_escape_literal($payload->data_nasterii) . ', gen = ' . pg_escape_literal($payload->gen) . ', nationalitate = ' . pg_escape_literal($payload->nationalitate) . ', ocupatie = ' . pg_escape_literal($payload->ocupatie) . ', studies = ' . pg_escape_literal($payload->studies) . ', reason = ' . pg_escape_literal($payload->reason) . ', phone_no = ' . pg_escape_literal($payload->phone_no) . ', email = ' . pg_escape_literal($payload->email) . ', link_facebook = ' . pg_escape_literal($payload->link_facebook) . ', pass_hash = ' . pg_escape_literal('' . hash('sha256', $payload->pass_hash)) . ', profile_pic = ' . pg_escape_literal($payload->profile_pic) . ', updated_on = current_timestamp WHERE id = ' . $volunteer_id;
        
        // print_r($query);

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'delete_volunteer_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'delete_volunteer_from_assoc', array());
            $result = pg_get_result($db_conn);
        }

        $cmdtuples = pg_affected_rows($result);

        if (!$cmdtuples){
            return false;
        }

        return true;

    
    }

    function delete_volunteer_by_id($id) {
        $db_conn = $GLOBALS['db'];

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'delete_volunteer', 'DELETE FROM tblVolunteers WHERE id =' . $id);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'delete_volunteer', array());
            $result = pg_get_result($db_conn);
        }

        $cmdtuples = pg_affected_rows($result);

        pg_close();

        if (!$cmdtuples){
            return false;
        }
        
        return true;
    }

    function get_associations_of_volunteer_by_id($id){
        $db_conn = $GLOBALS['db'];

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_asoc_of_vol', 'SELECT nume from vvolunteerdashboard WHERE vol_id='.$id);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_asoc_of_vol', array());
            $result = pg_get_result($db_conn);
        }

        // print_r($all_associations);

        $all_sscociations = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        return $all_sscociations;
    }

    function get_volunteer_tasks_from_association($volunteer_id, $association_id){
        $db_conn = $GLOBALS['db'];

        $result = '';
        $query = 'SELECT * from tbltasks tsk JOIN vvolunteeractivity acty ON tsk.id = acty.task_id WHERE acty.vol_id =' . $volunteer_id . ' AND  acty.assoc_id= '.$association_id;
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_tasks_of_vol_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_tasks_of_vol_from_assoc', array());
            $result = pg_get_result($db_conn);
        }
        
        $tasks = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        
        return $tasks;
    }

    function remove_volunteer_from_association($volunteer_id, $association_id){
        $db_conn = $GLOBALS['db'];

        $query = 'DELETE FROM tblvolassoc WHERE vol_id = ' . $volunteer_id . ' AND assoc_id = ' . $association_id;

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'delete_volunteer_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'delete_volunteer_from_assoc', array());
            $result = pg_get_result($db_conn);
        }

        $cmdtuples = pg_affected_rows($result);

        if (!$cmdtuples){
            return false;
        }

        return true;
    }

    function get_volunteer_activity_from_association($volunteer_id, $association_id){
        $db_conn = $GLOBALS['db'];

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_tasks_of_vol_from_assoc', 'SELECT * from vvolunteeractivity WHERE vol_id=' . $volunteer_id . 'AND assoc_id='.$association_id);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_tasks_of_vol_from_assoc', array());
            $result = pg_get_result($db_conn);
        }
        
        $activity = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        
        return $activity;
    }

    function get_volunteer_task_by_id_from_association($volunteer_id, $association_id, $task_id){
        $db_conn = $GLOBALS['db'];
    
        $result = '';
        $query = 'SELECT * from tbltasks tsk JOIN vvolunteeractivity acty ON tsk.id = acty.task_id WHERE acty.vol_id =' . $volunteer_id . ' AND  acty.assoc_id= '.$association_id. ' AND tsk.id = '.$task_id;
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_tasks_of_vol_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_tasks_of_vol_from_assoc', array());
            $result = pg_get_result($db_conn);
        }
        
        $task = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        
        return $task;
    }

    function get_volunteer_all_tasks($volunteer_id){
        $db_conn = $GLOBALS['db'];

        $result = '';
        $query = 'SELECT * from tbltasks tsk JOIN vvolunteeractivity acty ON tsk.id = acty.task_id WHERE acty.vol_id =' . $volunteer_id;
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_tasks_of_vol_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_tasks_of_vol_from_assoc', array());
            $result = pg_get_result($db_conn);
        }
        
        $tasks = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        
        return $tasks;
    }

    function get_volunteer_task_by_id($volunteer_id, $task_id){
        $db_conn = $GLOBALS['db'];

        $query = 'SELECT * from tbltasks tsk JOIN vvolunteeractivity acty ON tsk.id = acty.task_id WHERE acty.vol_id =' . $volunteer_id . ' AND tsk.id = '.$task_id;
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_tasks_of_vol_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_tasks_of_vol_from_assoc', array());
            $result = pg_get_result($db_conn);
        }
        
        $task = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        
        return $task;
    }

    function get_volunteer_review_by_id($volunteer_id){
        $db_conn = $GLOBALS['db'];

        $query = 'SELECT * FROM tblfeedback fb JOIN tblvolassoc va ON fb.volassoc_id = va.id WHERE va.vol_id = ' . $volunteer_id;
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_tasks_of_vol_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_tasks_of_vol_from_assoc', array());
            $result = pg_get_result($db_conn);
        }
        
        $review = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        
        return $review;
    }

    function get_volunteer_review_specific_task($volunteer_id, $task_id){
        $db_conn = $GLOBALS['db'];

        $query = 'SELECT * FROM tblfeedback fb JOIN tblvolassoc va ON fb.volassoc_id = va.id WHERE va.vol_id = ' . $volunteer_id . ' AND fb.task_id = '. $task_id;
        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_tasks_of_vol_from_assoc', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_tasks_of_vol_from_assoc', array());
            $result = pg_get_result($db_conn);
        }
        
        $review = pg_fetch_all($result, PGSQL_ASSOC);

        pg_close();
        
        return $review;
    }

    function give_feedback($volunteer_id, $task_id, $payload){ //TEORETIC MERGE, PRACTIC NU (mici buguri, de vazut cu constrangerile)
        $db_conn = $GLOBALS['db'];

        // print_r($task_id.'   '.$volunteer_id);

        $first_query = 'SELECT volassoc.id FROM tblvolassoc volassoc JOIN tbltasks tsk ON tsk.assoc_id = volassoc.assoc_id JOIN vvolunteeractivity vact ON vact.task_id = tsk.id WHERE tsk.id = ' . $task_id . ' AND volassoc.vol_id = ' . $volunteer_id;

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'retrive_data', $first_query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'retrive_data', array());
            $result = pg_get_result($db_conn);
        }

        $value = pg_fetch_array($result, NULL, PGSQL_ASSOC);

        if(isset($value)){
            return false;
        }

        $val = $value['id'];

        // print_r($val);

        $query = 'INSERT INTO tblfeedback (id, task_id, volassoc_id, harnic, comunicativ, disponibil, punctual, serios, descriere, for_volunteer, created_on, updated_on) VALUES (' . $payload->id .','. $task_id.',' . $val .','. $payload->harnic .','. $payload->comunicativ.','. $payload->disponibil. ','. $payload->punctual .','. $payload->serios .','. pg_escape_literal($payload->descriere) .','. $payload->for_volunteer .', current_timestamp, current_timestamp)';
        
        print_r($query);

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'give_feedback', $query);

            $res = pg_get_result($db_conn);
        }
        
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'give_feedback', array());
            $result = pg_get_result($db_conn);
        }

        $cmdtuples = pg_affected_rows($result);

        if (!$cmdtuples){
            return false;
        }

        return true;
    }
}