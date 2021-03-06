<?php

require_once __DIR__ . '/../models/volunteerModel.php';

class Volunteer {
    public function index() {
        $this -> dashboard();
    }

    public function dashboard() {
        // signed in volunteer looking at his dashboard

        if(!isset($_SESSION['id'])){
            redirect('/../user/login');
        }

        $volunteer = new VolunteerModel();
        $volunteer->readAssociations($_SESSION['id']);
        $volunteer->readSuggestedAssociations($_SESSION['id']);
        $volunteer->readPersonalDetails($_SESSION['id']);

        require_once __DIR__ . '/../views/volunteerDashboard.php';
    }

    public function profile() {
        // signed in volunteer looking at his profile
        $volunteer = new VolunteerModel();
        $volunteer->readPersonalDetails($_SESSION['id']);
        $volunteer->readFeedback($_SESSION['id']);

        require_once __DIR__ . '/../views/volunteerProfile.php';
    }

    public function activity($params) {
        // signed in volunteer looking at his activity in an assoc
        $volunteer = new VolunteerModel();
        $volunteer->readPersonalDetails($_SESSION['id']);
        if (isset($params[0]) && $params[0]!="")
            $volunteer->readActivity($params[0]);
        else
            $volunteer->readActivity(null);

        require_once __DIR__ . '/../views/volunteerActivity.php';
    }

    
}