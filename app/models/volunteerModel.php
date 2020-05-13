<?php

class VolunteerModel {
    public $associations = [];
    public $suggestedAssociations = [];
    public $personalDetails = [];
    public $username = "_username_";
    public $pic = "no-photo.jpg";

    public function __construct()
    {
        // read from db associations this volunteer has enrolled in
        $this -> readAssociations($GLOBALS['user_id']);
        $this -> readSuggestedAssociations($GLOBALS['user_id']);
        
        $this -> readPersonalDetails($GLOBALS['user_id']);
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
            
        for ($xi = 0; $xi < pg_num_rows($result); $xi++) {
            $assoc = pg_fetch_assoc($result);
            $this -> associations[] = $assoc;
        }
    }

    //TODO create a new view in the database
    function readSuggestedAssociations($vol_id) {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            pg_send_prepare($conn, 'get_suggested_associations', 'SELECT DISTINCT assoc_id, nume, logo FROM vVolunteerDashboard
            WHERE vol_id <> $1');

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
}