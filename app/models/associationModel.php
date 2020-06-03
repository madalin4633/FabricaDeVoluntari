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

    //TODO nested tables in SQL?
    public function readActivity($vol_id)
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
            $params[] = $GLOBALS['user_id'];
            if (isset($vol_id)) {
                $params[] = $vol_id;
            }
            pg_send_execute($conn, 'get_activity', $params);
            $result = pg_get_result($conn);
        }

        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $this -> activity[] = pg_fetch_assoc($result);
        }


        // activity details
        if (!pg_connection_busy($conn)) {
            $query = "SELECT * 
            FROM vActivityEnrolledVolunteers 
            WHERE assoc_id=$1 
            ORDER BY task_id ASC";

            pg_send_prepare($conn, 'get_activityDetails', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $GLOBALS['user_id'];
            pg_send_execute($conn, 'get_activityDetails', $params);
            $resultDetails = pg_get_result($conn);
        }

        $act_row = 0;
        for ($xi = 0; $xi < pg_num_rows($resultDetails); $xi++) {
            $array = pg_fetch_assoc($resultDetails);
            $task_id = $array['task_id'];

            if ($this->activity[$act_row]['task_id'] != $task_id) {
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

    function get_myassociation_activity($assoc_id){ //de terminat aici cu view-ul corect
        $db_conn = $GLOBALS['db'];

        if (!pg_connection_busy($db_conn)) {
            pg_send_prepare($db_conn, 'get_my_activity', 'SELECT nume_prenume, SUM(hours_worked) AS ore_lucrate FROM vMyAssociationActivity WHERE assoc_id =$1 GROUP BY nume_prenume');
    
            $res = pg_get_result($db_conn);
        }
          
        if (!pg_connection_busy($db_conn)) {
            pg_send_execute($db_conn, 'get_my_activity', array($assoc_id));
            $result = pg_get_result($db_conn);
        }
    
        $row = pg_fetch_all($result, PGSQL_ASSOC);
        pg_close();

        // $row = json_encode($row);
        return $row;
    }
}
