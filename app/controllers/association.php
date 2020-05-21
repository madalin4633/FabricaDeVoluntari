<?php

// TODO change to associationModel in all places, after it's done
require_once __DIR__ . '/../models/volunteerModel.php';

class Association {
    public function index() {
        $this -> reports();
    }

    public function reports() {
        // signed in volunteer looking at his dashboard
        $volunteer = new VolunteerModel();

        require_once __DIR__ . '/../views/assocReports.php';
    }

    // public function profile() {
    //     // signed in volunteer looking at his dashboard
    //     $volunteer = new VolunteerModel();

    //     require_once __DIR__ . '/../views/assocProfile.php';
    // }
}