<?php

require_once __DIR__ . '/../models/volunteer.php';

class VolunteerDashboard {
    public function index() {
        echo 'from volunteer dashboard';

        // signed in volunteer looking at hos dashboard
        $volunteer = new Volunteer();

    }
}