<?php
    class Users extends App {
        public function __construct(){

        }

        public function register(){
            //CHECK FOR POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form
            
            
            
            } 
            else{
                //init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_pass_err' => ''
                ];
                //load view
                $this->view('signup', $data);

            }
        }

        public function login(){
            //CHECK FOR POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form
            
            
            
            } 
            else{
                //init data
                $data = [
                    'name' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                ];
                //load view
                $this->view('login', $data);

            }
        }
    }