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
            $params[] = $_SESSION['assoc_id'];
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
            $params[] = $assoc_id;
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
            $params[] = $assoc_id;
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


}
