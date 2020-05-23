<?php
    class User extends App {

        public function __construct(){
            $this->userModel = $this->model('AuthentificationModel');
        }

        public function register(){

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
            
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['as_name'])){
                    die("este o asociatie");
                }

                // Init data
                $data =[
                    'name' => trim($_POST['name']),
                    'surname' => trim($_POST['surname']),
                    'birthday' => trim($_POST['birthday']),
                    'phone' => trim($_POST['phone']),
                    'email' => trim($_POST['email']),
                    'gender' => trim($_POST['gender']),
                    'status' => trim($_POST['status']),
                    'institution' => trim($_POST['institution']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'accord' => trim($_POST['accord']),
                    'name_err' => '',
                    'surname_err' => '',
                    'birthday_err' => '',
                    'phone_err' => '',
                    'email_err' => '',
                    'gender_err' => '',
                    'status_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'accord_err' => ''
                ];
                
                $err_fields = 0;

                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Please enter name';
                    $err_fields++;
                }
                
                // Validate Surame
                if(empty($data['surname'])){
                    $data['surname_err'] = 'Please enter surname';
                    $err_fields++;
                }

                // Validate Birthday
                if(empty($data['birthday'])){
                    $data['birthday_err'] = 'Please enter birthday';
                    $err_fields++;
                }

                // Validate Phone
                if(empty($data['phone'])){
                    $data['phone_err'] = 'Please enter phone';
                    $err_fields++;
                }

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                    $err_fields++;
                }

                // Validate Gender
                if(empty($data['gender'])){
                    $data['gender_err'] = 'Please select gender';
                    $err_fields++;
                }

                // Validate Status
                if(empty($data['status'])){
                    $data['status_err'] = 'Please select status';
                    $err_fields++;
                }

                // Validate Institution
                if(empty($data['institution'])){
                    $data['institution_err'] = 'Please enter institution';
                    $err_fields++;
                }
        
                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                    $err_fields++;
                } elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                    $err_fields++;
                }
        
                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                    $err_fields++;
                } else {
                    if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Passwords do not match';
                    $err_fields++;
                    }
                }

                // Check accord
                if($data['accord'] <> "yes"){
                    $data['accord_err'] = 'Please sign accord';
                    $err_fields++;
                }
        
                // Make sure errors are empty
                if($err_fields == 0){
                    // SUCCESS - Proceed to inser
                    
                    if($this->userModel->register($data)){
                        flash('register_success', 'You are now registered and can log in');
                        redirect('/user/login');
                    }
                    else{
                        die('Something went wrong');
                    }
                    
                } else {
                    // Load view with errors
                    print_r($data);
                    die('Something went wrong');
                }
      
            } else {
              // Init data -- NOT A POST REQUEST
                $data =[
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
        
                // Load view
                $this->view('signup', $data);
            }
          }
      
          public function login(){

            if ($this->isLoggedIn()){
                redirect('/../volunteer/dashboard');
            }

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Init data
                $data =[
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',      
                ];

                $err_fields = 0;
        
                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                    $err_fields++;
                }
        
                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                    $err_fields++;     
                }

                // Make sure errors are empty
                if($err_fields == 0){
                    // Validated
                    
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                
                    if($loggedInUser){
                        //User Authentificated
                        $this->createUserSession($loggedInUser);
                    }
                    else{
                        $data['password_err'] = 'Password incorrect';
                        $this->view('login', $data);
                    }

                } else {
                    // Load view with errors
                    $this->view('login', $data);
                }
        
        
                } else {
                // Init data
                $data =[    
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',        
                ];
        
                // Load view
                $this->view('login', $data);
                }
          }

          public function createUserSession($user){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email']; 
            $_SESSION['user_name'] = $user['username'];
            redirect('http://localhost:8888/volunteer/dashboard');
          }

          public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('/user/login');
          }

          public function isLoggedIn(){
            if(isset($_SESSION['user_id'])){
              return true;
            } else {
              return false;
            }
          }
    }