<?php

class BadgrModel {
    public $access_token;
    public $refresh_token;

    public function __construct()
    {
        $this -> readTokens();
    }

    public function readTokens() {
        $conn = $GLOBALS['db'];

        if (!pg_connection_busy($conn)) {
            $query = 'SELECT tblbadgr.access_token, tblbadgr.refresh_token FROM tblBadgr WHERE id=1';

            pg_send_prepare($conn, 'get_badgr_token',  $query);
            $res = pg_get_result($conn);
        }

        if (!pg_connection_busy($conn)) {
            pg_send_execute($conn, 'get_badgr_token', array());
            $result = pg_get_result($conn);
        }
        $value = pg_fetch_row($result);

        $this -> access_token = $value[0];
        $this -> refresh_token = $value[1];
    }
}
?>