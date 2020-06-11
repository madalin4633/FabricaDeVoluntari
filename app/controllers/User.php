<?php
    class User extends App {

        public function __construct(){
            $this->userModel = $this->model('AuthentificationModel');
        }

        function is_volunteer_logged_in(){
            
            if(isset($_SESSION['id']) && $_SESSION['is_volunteer']){
                return true;
            }   
            return false;
        }

        function is_association_logged_in(){
            if(isset($_SESSION['id']) && $_SESSION['is_association']){
                return true;
            }   
            return false;
        }

        function register(){

            if($this->is_volunteer_logged_in()){
                redirect('/../volunteer/dashboard');
            }

            if($this->is_association_logged_in()){
                redirect('/../association/activity');
            }

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
            
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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
                    'accord_err' => '',
                    'error' => '',
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
                    // SUCCESS - Proceed to insert
                    
                    if($this->userModel->register($data)){
                        flash('register_success', 'You are now registered and can log in');
                        // redirect('/user/login');
                        $_SESSION['fresh_registered'] = true;
                        redirect('/user/login');
                    }
                    else{
                        echo "<script>alert('Deja exista un cont cu acest email. Va rugam sa incercati cu alt email'); window.location = '/user/register';</script>";
                    }
                    
                } else {
                    echo "<script>alert('$data'); window.location = '/user/register';</script>";
                }
      
            } else {
              // Init data -- NOT A POST REQUEST
                $data =[
                    // 'name' => '',
                    // 'email' => '',
                    // 'password' => '',
                    // 'confirm_password' => '',
                    // 'name_err' => '',
                    // 'email_err' => '',
                    // 'password_err' => '',
                    // 'confirm_password_err' => ''
                ];
        
                // Load view
                $this->view('signup', $data);
            }
          }

         public function register_asociatie(){          

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
            
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $data =[
                    'as_name' => trim($_POST['as_name']),
                    'owner' => trim($_POST['owner']),
                    'registrery' => trim($_POST['registrery']),
                    'birthday' => trim($_POST['birthday']),
                    'phone' => trim($_POST['phone']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'accord' => trim($_POST['accord']),
                    'as_err' => '',
                    'owner_err' => '',
                    'registrery_err' => '',
                    'phone_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'accord_err' => '',
                    'error' => '',
            
                ];
                
                $err_fields = 0;

                // Validate Name
                if(empty($data['as_name'])){
                    $data['as_name_err'] = 'Please enter name';
                    $err_fields++;
                }
                
                // Validate owner
                if(empty($data['owner'])){
                    $data['owner_err'] = 'Please enter surname';
                    $err_fields++;
                }

                // Validate Registrery
                if(empty($data['registrery'])){
                    $data['registrery_err'] = 'Please enter birthday';
                    $err_fields++;
                }

                // Validate Birthday
                if(empty($data['birthday'])){
                    $data['birthday_err'] = 'Please enter phone';
                    $err_fields++;
                }

                // Validate Phone
                if(empty($data['phone'])){
                    $data['phone_err'] = 'Please enter email';
                    $err_fields++;
                }

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please select gender';
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
                    // SUCCESS - Proceed to insert
                    
                    if($this->userModel->register_asoc($data)){
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

            if($this->is_volunteer_logged_in()){
                redirect('/../volunteer/dashboard');
            }

            if($this->is_association_logged_in()){
                redirect('/../association/activity');
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
                    'error' => '',  
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
                    
                    $logged = false;
                    

                    $association_data = $this->userModel->login_as_association($data['email'], $data['password']);

                    if($association_data){
                        $this->createUserSession($association_data, 'association');
                        $logged = true;
                    }
                    
                    if (!$logged){
                        $volunteer_data = $this->userModel->login_as_volunteer($data['email'], $data['password']);

                        if($volunteer_data){
                            $this->createUserSession($volunteer_data, 'volunteer');
                            $logged = true;
                        }
                    }

                    if (!$logged){
                        $admin_data = $this->userModel->login_as_admin($data['email'], $data['password']);
                        
                        if($admin_data){
                            $this->createUserSession($admin_data, 'admin');
                            $logged = true;
                        }
                    }
                
                    if(!$logged){
                        $data['error'] = 'Email sau parola incorecta';
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
                    'error' => '',      
                ];
        
                // Load view
                $this->view('login', $data);
                }
        }

        public function createUserSession($user, $entity){

            $_SESSION['id'] = $user['id'];
            
            if ($entity == 'volunteer'){
                $_SESSION['is_volunteer'] = true;
                $_SESSION['is_association'] = false;
                $_SESSION['email'] = $user['email']; 
                
                if(isset($_SESSION['waiting_for_login'])){

                    $_SESSION['joined_into_assoc'] = true;
                    
                    $redirect_url = $_SESSION['waiting_for_login'];
                    
                    unset($_SESSION['waiting_for_login']);
                    
                    redirect($redirect_url);
                
                }else{
                    redirect('/volunteer/dashboard');
                }
            }

            if ($entity == 'association'){
                $_SESSION['email'] = $user['email']; 
                $_SESSION['is_volunteer'] = false;
                $_SESSION['is_association'] = true;
                redirect('/association/activity');
            }

            if ($entity == 'admin'){
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_volunteer'] = true;
                $_SESSION['is_association'] = true;
                redirect('/admin');
            }
            
        }

        public function logout(){
            unset($_SESSION['id']);
            unset($_SESSION['email']);
            unset($_SESSION['is_volunteer']);
            unset($_SESSION['is_association']);
            if(isset($_SESSION['username'])){
                unset($_SESSION['username']);
            }
            session_destroy();
            redirect('/user/login');
        }

        public function login_with_facebook(){

            require_once __DIR__ . '/../models/Facebook/autoload.php';

            $facebook_object = new \Facebook\Facebook([
                'app_id' => '553021665576342',
                'app_secret' => 'c956e201d44e91b884acd391bb2a151f',
                'default_graph_version' => 'v2.10'
            ]);
            
            $handler = $facebook_object -> getRedirectLoginHelper();
                
            $redirect_path = 'http://'. $_SERVER['HTTP_HOST'] . '/user/login_facebook_pipe';
            $data = ['email'];
            $fullURL = $handler->getLoginUrl($redirect_path, $data);

            return $fullURL;
        }

        public function login_facebook_pipe(){
            require_once __DIR__ . '/../models/Facebook/autoload.php';

            $facebook_object = new \Facebook\Facebook([
                'app_id' => '553021665576342',
                'app_secret' => 'c956e201d44e91b884acd391bb2a151f',
                'default_graph_version' => 'v2.10'
            ]);
            
            $handler = $facebook_object -> getRedirectLoginHelper();

            try{
                $accessToken = $handler->getAccessToken();
            }catch(\Facebook\Exceptions\FacebookResponseException $e){
                echo "Response Exception: " . $e->getMessage();
                exit();
            }catch(\Facebook\Exceptions\FacebookSDKException $e){
                echo "SDK Exception: " . $e->getMessage();
                exit();
            }

            if(!$accessToken){
                redirect('/user/login');
            }

            $oAuth2Client = $facebook_object->getOAuth2Client();
            if(!$accessToken->isLongLived())
                $accessToken = $oAuth2Client->getLongLivedAccesToken($accessToken);

            $response = $facebook_object->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
            $userData = $response->getGraphNode()->asArray();

            $loggedIn = false;

            $volunteer_data = $this->userModel->login_as_volunteer($userData['email'], 0);

            if($volunteer_data){
                
                $_SESSION['id'] = $volunteer_data['id'];
                $_SESSION['email'] = $volunteer_data['email'];
                $_SESSION['is_volunteer'] = true;
                $_SESSION['is_association'] = false;
                $_SESSION['userData'] = $userData;
                $_SESSION['access_token'] = (string) $accessToken;

                $loggedIn = true;
                
                if(isset($_SESSION['waiting_for_login'])){
                        
                    $redirect_url = $_SESSION['waiting_for_login'];
                    
                    unset($_SESSION['waiting_for_login']);
                    
                    redirect($redirect_url);
                
                }else{
                    redirect('/volunteer/dashboard');
                }
            }

            if(!$loggedIn){
                
                $association_data = $this->userModel->login_as_association($userData['email'], 0);

                if ($association_data){
                    $_SESSION['id'] = $volunteer_data['id'];
                    $_SESSION['email'] = $volunteer_data['email'];
                    $_SESSION['is_volunteer'] = true;
                    $_SESSION['is_association'] = false;
                    $_SESSION['userData'] = $userData;
                    $_SESSION['access_token'] = (string) $accessToken;

                    $loggedIn = true;

                    redirect('/association/activity');
                }
            }
            
            if(!$loggedIn){
                $data = $userData;
                $this->view('signup', $data);
            }
            
        }

        public function joinAssociation(){
            
            $invitation_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            
            if(!$this->is_volunteer_logged_in()){

                $_SESSION['waiting_for_login'] =  $invitation_link;
               
                redirect('/user/login');

            }else{
                
                require_once __DIR__ . "/../models/associationModel.php";

                $association = new AssociationModel();

                $association_id = $association->get_association_id_by_invite_link($invitation_link);

                if($association_id){

                    require_once __DIR__ . "/../models/volunteerModel.php";

                    $volunteer = new VolunteerModel();

                    $result = $volunteer->join_association($_SESSION['id'], $association_id);

                    if($result){

                        redirect('/../../volunteer/dashboard');
                        
                    }else{

                        die("Ne pare rau, dar a aparut o problema. Contactati un coordonator");

                    }
                    

                }else{

                    die("Ne pare rau, dar recrutarile sunt acum inchise. Te asteptam sa te alaturi data viitoare. Pentru nelamuriri contactati un coordonator.");

                }

            }
        }
    }