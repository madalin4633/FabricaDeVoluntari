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
        $association->readActivity($_SESSION['assoc_id'], null);
        $association->readPersonalDetails($_SESSION['assoc_id']);


        if (isset($_REQUEST['add']) && $_REQUEST['add'] == 'addTask') {
            if ($error = $association->addTask($_POST['title'], $_POST['descr'], $_POST['obs'],$_POST['max_volunteers'], $_POST['due_date'])) {
                $GLOBALS['user-notifications']->addNotification("Form data is invalid!\n" . $error );
                require_once __DIR__ . '/../views/associationActivity.php';
                exit();
            }
                
            header("location: /association/activity");
            exit();
        }

        require_once __DIR__ . '/../views/associationActivity.php';
    }

}