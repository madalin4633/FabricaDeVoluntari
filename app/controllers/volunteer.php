<?php

require_once __DIR__ . '/../models/volunteerModel.php';

class Volunteer {
    public function dashboard() {
        // signed in volunteer looking at his dashboard
        $volunteer = new VolunteerModel();

        require_once __DIR__ . '/../views/volunteerDashboard.php';
    }

    public function profile() {
        // signed in volunteer looking at his dashboard
        $volunteer = new VolunteerModel();

        require_once __DIR__ . '/../views/volunteerProfile.php';
    }
}