<?php

class VolunteerModel {
    public $id;
    public $associations = [];
    public $suggestedAssociations = [];
    public $personalDetails = [];
    public $username = "_username_";
    public $pic = "no-photo.jpg";
    public $rating = 0;

    public function __construct()
    {
        $this -> id = $_SESSION['user_id'];

        // $this -> readAssociations($this->id);

        // $this -> readSuggestedAssociations($this->id);
        
        // $this -> readPersonalDetails($this->id);
    }


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
                $this-> pic = "joshua-reddekopp-rTpR03TCFGQ-unsplash.jpg";
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

        $query = 'DELETE FROM tblvolassoc WHERE vol_id =' . $volunteer_id . 'AND assoc_id=' . $association_id;

        print_r($query);

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
}