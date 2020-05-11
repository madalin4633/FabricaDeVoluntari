<?php

class VolunteerModel {
    public $associations = [];
    
    public function __construct()
    {
        // read from db associations this volunteer has enrolled in
            $conn = $GLOBALS['db'];

            if (!pg_connection_busy($conn)) {
                pg_send_prepare($conn, 'get_associations', 'SELECT * FROM vVolunteerDashboard
                WHERE vol_id = $1');

                $res = pg_get_result($conn);
            }
            
            if (!pg_connection_busy($conn)) {
                pg_send_execute($conn, 'get_associations', array("6"));
                $result = pg_get_result($conn);
            }
            
        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $assoc = pg_fetch_assoc($result);
            $this -> associations[] = $assoc;
        }
    }
}