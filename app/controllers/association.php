<?php

// TODO change to associationModel in all places, after it's done
require_once __DIR__ . '/../models/associationModel.php';

class Association {
    public function index() {
        $this -> activity();
    }

    public function reports() {
        // signed in association looking at his dashboard
        $association = new AssociationModel();

        require_once __DIR__ . '/../views/assocReports.php';
    }

    public function profile() {
        // signed in assoc looking at his profile
        $association = new AssociationModel();
        $association->readPersonalDetails($_SESSION['id']);
        $association->readFeedback($_SESSION['id']);

        require_once __DIR__ . '/../views/associationProfile.php';
    }

    public function activity($params) {
        // signed in association looking at his dashboard
        $association = new AssociationModel();
        $association->readProjects($_SESSION['id'], ((isset($params[0]) && $params[0]!="") ? $params[0] : null));
        $association->readPersonalDetails($_SESSION['id']);

        if (isset($_REQUEST['add']) && $_REQUEST['add'] == 'addProject') {
            if ($error = $association->addProject($_POST['title'], $_POST['descr'])) {
                $GLOBALS['user-notifications']->addNotification("Form data is invalid!\n" . $error );
                require_once __DIR__ . '/../views/associationActivity.php';
                exit();
            }
                
            header("location: /association/activity");
            exit();
        }

        if (isset($_REQUEST['add']) && $_REQUEST['add'] == 'addTask') {
            if ($error = $association->addTask($_POST['projId'], $_POST['title'], $_POST['descr'], $_POST['obs'],$_POST['max_volunteers'], $_POST['hours'], $_POST['due_date'])) {
                $GLOBALS['user-notifications']->addNotification("Form data is invalid!\n" . $error );
                require_once __DIR__ . '/../views/associationActivity.php';
                exit();
            }
                
            header("location: /association/activity");
            exit();
        }

        require_once __DIR__ . '/../views/associationActivity.php';
    }

    public function recruitments(){
        require_once __DIR__ . '/../views/recruitments.php';
    }

}