<?php

require_once __DIR__ . '/../models/volunteerModel.php';

class Volunteer {
    public function index() {
        // signed in volunteer looking at his dashboard
        $volunteer = new VolunteerModel();

        require_once __DIR__ . '/../views/userprofile.html';
    }
}