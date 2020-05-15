<?php

class Notifications {
    private $notifications = [];

    public function addNotification($msg) {
        $this -> notifications[] = $msg;
    }

    public function showNotifications() {
        foreach($this->notifications as $msg) {
            echo "<div class='notification' >$msg<button>close</button></div>";
        }
    }
}