<?php

class AuthentificationModel extends App {
      
    private $db_conn;
      
    public function __construct(){

        $this->db_conn = $GLOBALS['db'];
        
    }

    public function register($data){
        
        $query = 'INSERT INTO tblVolunteers 
        (nume, prenume, username, email, gen, phone_no, nationalitate, data_nasterii, profile_pic, created_on, updated_on, pass_hash) VALUES 
        ('. pg_escape_literal($data['name']) . ',' . pg_escape_literal($data['surname']) . ','  . pg_escape_literal($data['surname'] . $data['name']) . 
          ',' . pg_escape_literal($data['email']) . ',' . pg_escape_literal($data['gender']) . ',' . pg_escape_literal($data['phone']) . ',' .
          pg_escape_literal('RO') . ',' . pg_escape_literal($data['birthday']) . ',' . pg_escape_literal('tare') .','. 'current_timestamp, current_timestamp' . ','. pg_escape_literal('' . hash('sha256', $data['password'])) . ')';
        // print_r($query);
        return pg_query($this->db_conn, $query);
    }

    public function register_asoc($data){
        $query = 'INSERT INTO tblassociations 
        (nume, reprezentant, nr_inreg, data_infiintare, email, phone_no, created_on, updated_on, pass_hash) VALUES 
        ('. pg_escape_literal($data['as_name']) . ',' . pg_escape_literal($data['owner']) . ','  . pg_escape_literal($data['registrery']) . 
          ',' . pg_escape_literal($data['birthday']) . ',' . pg_escape_literal($data['email']) . ',' . pg_escape_literal($data['phone']) . ',' .
          'current_timestamp, current_timestamp' . ','. pg_escape_literal('' . hash('sha256', $data['password'])) . ')';
        // print_r($query);
        return pg_query($this->db_conn, $query);
    }

    public function login_as_volunteer($email, $password){
      
        $res = '';
        $result = '';

        $query = 'SELECT * FROM tblvolunteers WHERE email = $1';

        if (!pg_connection_busy($this->db_conn)) {
          pg_send_prepare($this->db_conn, 'get_user_row', $query);

          $res = pg_get_result($this->db_conn);
        }
        
        if (!pg_connection_busy($this->db_conn)) {
          pg_send_execute($this->db_conn, 'get_user_row', array($email));
          $result = pg_get_result($this->db_conn);
        }

        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
        
        if(empty($row)){
          return false;
        }

        if($password == 0){
          return $row;
        }

        $pass_hash = hash('sha256', $password);

        if ($row['pass_hash'] == $pass_hash){
          return $row;
        }
        
        return false;
    }

    public function login_as_association($email, $password){

        $res = '';
        $result = '';
        if (!pg_connection_busy($this->db_conn)) {
          pg_send_prepare($this->db_conn, 'get_association_row', 'SELECT * FROM tblassociations WHERE email = $1');

          $res = pg_get_result($this->db_conn);
        }
        
        if (!pg_connection_busy($this->db_conn)) {
          pg_send_execute($this->db_conn, 'get_association_row', array($email));
          $result = pg_get_result($this->db_conn);
        }

        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
        
        if(empty($row)){
          return false;
        }

        $pass_hash = hash('sha256', $password);

        if ($row['pass_hash'] == $pass_hash){
          return $row;
        }
        return false;
    }

    public function login_as_admin($username, $password){

        if (!pg_connection_busy($this->db_conn)) {
            pg_send_prepare($this->db_conn, 'get_admin_row', 'SELECT * FROM tbladmins WHERE username = $1');

            $res = pg_get_result($this->db_conn);
        }
        
        if (!pg_connection_busy($this->db_conn)) {
            pg_send_execute($this->db_conn, 'get_admin_row', array($username));
            $result = pg_get_result($this->db_conn);
        }

        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
        
        if(empty($row)){
          return false;
        }
        
        if ($row['password'] == $password){
          return $row;
        }
        return false;
    }
}