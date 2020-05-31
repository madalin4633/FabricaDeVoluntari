<?php

function dropViewAssociationActivity($conn)
{
    try {

        pg_query($conn, 'DROP VIEW vAssociationActivity;');
        echo 'View vAssociationActivity dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vAssociationActivity: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewAssociationActivity($conn)
{
    if (pg_query($conn, "CREATE VIEW vAssociationActivity AS
            select tblTasks.id as task_id, tblVolAssoc.assoc_id, tblAssociations.logo, title, descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tbltasks 
            INNER JOIN tblActivity ON tblTasks.id=tblActivity.task_id
            INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblTasks.assoc_id
            INNER JOIN tblAssociations ON tblTasks.assoc_id=tblAssociations.id
            WHERE tblTasks.active=true and done=false
            GROUP BY tblTasks.id, tblVolAssoc.assoc_id, title, descr, obs, due_date, tblAssociations.logo
                  ")) {
        echo "View vAssociationActivity created!<br>";
    } else {
        echo "View vAssociationActivity failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

function dropViewActivityEnrolledVolunteers($conn)
{
    try {

        pg_query($conn, 'DROP VIEW vActivityEnrolledVolunteers;');
        echo 'View vActivityEnrolledVolunteers dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vActivityEnrolledVolunteers: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewActivityEnrolledVolunteers($conn)
{
    if (pg_query($conn, "CREATE VIEW vActivityEnrolledVolunteers AS
        SELECT task_id, vol_id, LEFT(tblVolunteers.nume,1) || LEFT(tblVolunteers.prenume,1) as initials, tblTasks.assoc_id, sum(hours_worked) as hours, profile_pic
        FROM tblTasks 
        LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
        INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id
        INNER JOIN tblVolunteers ON tblVolAssoc.vol_id = tblVolunteers.id
        GROUP BY vol_id, task_id, profile_pic, tblTasks.assoc_id, tblVolunteers.nume, tblVolunteers.prenume
        ORDER BY task_id ASC
")) {
        echo "View vActivityEnrolledVolunteers created!<br>";
    } else {
        echo "View vActivityEnrolledVolunteers failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

