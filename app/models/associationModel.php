<?php

class AssociationModel
{
    public $volunteers = [];
    public $activity =[];
    public $completed =[];
    public $projects = [];
    public $personalDetails = [];
    public $pic = "no-logo-png-4.png";
    public $nume = "";

    public function __construct()
    {
    }

    public function addProject($title, $desc) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = "INSERT INTO tblProjects (assoc_id, title, descr, created_on, updated_on) 
            VALUES ($1,$2,$3, current_timestamp, current_timestamp)";

            pg_send_prepare($conn, 'add_proj', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $_SESSION['id'];
            $params[] = $title;
            $params[] = $desc;

            pg_send_execute($conn, 'add_proj', $params);
            $result =  pg_get_result($conn);
            return pg_result_error($result);
        }
    }

    public function addTask($proj_id, $title, $desc, $obs, $max_volunteers, $hours, $duedate) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = "INSERT INTO tblTasks (proj_id, title, descr, obs, max_volunteers, hours_worked, created_on, updated_on, due_date) 
            VALUES ($1,$2,$3, $4, $5, $7, current_timestamp, current_timestamp, $6)";

            pg_send_prepare($conn, 'add_task', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $proj_id;
            $params[] = $title;
            $params[] = $desc;
            $params[] = $obs;
            $params[] = $max_volunteers;
            $params[] = $duedate;
            $params[] = $hours;

            pg_send_execute($conn, 'add_task', $params);
            $result =  pg_get_result($conn);
            return pg_result_error($result);
        }
    }



    private function readActivity($proj_id, $vol_id)
    {
        $conn = $GLOBALS['db'];


        if (!pg_connection_busy($conn)) {
            $query = "SELECT 
            task_id,
            title,
            logo as assoclogo,
            descr,
            obs,
            due_date,
            task_done
            FROM vAssociationActivity 
            WHERE proj_id=$1 AND task_done=false
            ORDER BY task_id ASC";

            pg_send_prepare($conn, 'get_assoc_activity', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $proj_id;
            if (isset($vol_id)) {
                $params[] = $vol_id;
            }
            pg_send_execute($conn, 'get_assoc_activity', $params);
            $result = pg_get_result($conn);
        }

        $activity = [];
        if (isset($result))
        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $activity[] = pg_fetch_assoc($result);
        }

        if (count($activity) == 0) return $activity;
        
        
        // activity details
        if (!pg_connection_busy($conn)) {
            $query = "SELECT * 
            FROM vActivityEnrolledVolunteers 
            WHERE proj_id=$1 AND done=false
            ORDER BY task_id ASC";

            pg_send_prepare($conn, 'get_activityDetails', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $proj_id;
            pg_send_execute($conn, 'get_activityDetails', $params);
            $resultDetails = pg_get_result($conn);
        }

        
        $act_row = 0;
        $activity[$act_row]['volunteers'] = [];
        
        if (isset($resultDetails) && count($activity) > 0)
        for ($xi = 0; $xi < pg_num_rows($resultDetails); $xi++) {
            $array = pg_fetch_assoc($resultDetails);
            $task_id = $array['task_id'];

            if (isset($activity[$act_row]['task_id']) && $activity[$act_row]['task_id'] != $task_id) {
                $act_row += 1;
            }
            $activity[$act_row]['volunteers'][] = $array;
        }
    
        return $activity;
    }

    private function readCompleted($proj_id, $vol_id)
    {
        $conn = $GLOBALS['db'];


        if (!pg_connection_busy($conn)) {
            $query = "SELECT 
            task_id,
            title,
            logo as assoclogo,
            descr,
            obs,
            due_date,
            task_done
            FROM vAssociationActivity 
            WHERE proj_id=$1 AND task_done=true
            ORDER BY task_id ASC";

            pg_send_prepare($conn, 'get_assoc_completed', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $proj_id;
            if (isset($vol_id)) {
                $params[] = $vol_id;
            }
            pg_send_execute($conn, 'get_assoc_completed', $params);
            $result = pg_get_result($conn);
        }

        $activity = [];
        if (isset($result))
        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $activity[] = pg_fetch_assoc($result);
        }

        if (count($activity) == 0) return $activity;
        
        
        // activity details
        if (!pg_connection_busy($conn)) {
            $query = "SELECT * 
            FROM vActivityEnrolledVolunteers 
            WHERE proj_id=$1 AND done=true
            ORDER BY task_id ASC";

            pg_send_prepare($conn, 'get_completedDetails', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $proj_id;
            pg_send_execute($conn, 'get_completedDetails', $params);
            $resultDetails = pg_get_result($conn);
        }

        
        $act_row = 0;
        $activity[$act_row]['volunteers'] = [];
        
        if (isset($resultDetails) && count($activity) > 0)
        for ($xi = 0; $xi < pg_num_rows($resultDetails); $xi++) {
            $array = pg_fetch_assoc($resultDetails);
            $task_id = $array['task_id'];

            if (isset($activity[$act_row]['task_id']) && $activity[$act_row]['task_id'] != $task_id) {
                $act_row += 1;
            }
            $activity[$act_row]['volunteers'][] = $array;
        }
    
        return $activity;
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
            
        if (isset($result) && pg_num_rows($result) > 0) {
            $this -> personalDetails = pg_fetch_assoc($result);
            if ($this -> personalDetails['_ignore_pic']) 
                $this -> pic ='logo/' . $this -> personalDetails['_ignore_pic'];
            $this->nume = $this->personalDetails['Nume'];
        }
    }

    function get_myassociation_activity($assoc_id, $filter_by){ //de adaugat inca un field la functie care sa fie de fapt acel parametru luat din formularul.. acum cate luni sau saptamani
        $db_conn = $GLOBALS['db'];
        switch ($filter_by) {
            case 'last_week':
                $interval='week';
                break;
            case 'last_month':
                $interval='month';
                break;
            case 'last_year':
                $interval='year';
                break;
            default:
                break;
        }
        $selectul = 'SELECT nume_prenume, SUM(hours_worked) AS ore_lucrate, COUNT(task_id) AS nr_taskuri, SUM(hours_worked)/COUNT(task_id) AS ora_task, TO_CHAR(max(updated_on),\'dd-mm-yyyy hh24:mi\') AS ultima_activitate
        FROM vMyAssociationActivity WHERE assoc_id=$1 AND (updated_on >= date_trunc(\'day\', CURRENT_TIMESTAMP - interval \'1' . $interval . '\') and updated_on < date_trunc(\'day\', CURRENT_TIMESTAMP))
        GROUP BY nume_prenume ORDER BY nume_prenume ASC';
        
        if (!pg_connection_busy($db_conn)) { //filter_by o sa seteze o valoare pt week month sau year si deci va fi prepared statement si el
                pg_send_prepare($db_conn, 'get_my_activity', $selectul);
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

    public function readProjects($assoc_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = "SELECT 
            id,
            title,
            descr
            FROM tblProjects 
            WHERE assoc_id=$1 AND active=true
            ";

            pg_send_prepare($conn, 'get_assoc_proj', $query);
            
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            $params=[];
            $params[] = $_SESSION['id']; // it was $assoc_id before merge
            pg_send_execute($conn, 'get_assoc_proj', $params);
            $result = pg_get_result($conn);
        }

        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $array = pg_fetch_assoc($result);
            $array['activity'] = $this->readActivity($array['id'], null);
            $array['completed'] = $this->readCompleted($array['id'], null);
            $this -> projects[] = $array;
        }
    }
}
