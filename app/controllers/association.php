<?php

// TODO change to associationModel in all places, after it's done
require_once __DIR__ . '/../models/associationModel.php';

class Association {
    public function index() {
        $this -> reports();
    }

    public function reports() {
        // signed in association looking at his dashboard
        $association = new AssociationModel();

        require_once __DIR__ . '/../views/assocReports.php';
    }

    public function activity() {
        // signed in association looking at his dashboard
        $association = new AssociationModel();
        $association->readActivity(null);
        $association->readPersonalDetails($_SESSION['id']);

        require_once __DIR__ . '/../views/associationActivity.php';
    }
}