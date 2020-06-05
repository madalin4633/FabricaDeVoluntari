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
            select tblTasks.id as task_id, tbltasks.assoc_id, tblAssociations.logo, title, descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tbltasks 
            LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
            LEFT JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblTasks.assoc_id
            LEFT JOIN tblAssociations ON tblTasks.assoc_id=tblAssociations.id
            WHERE tblTasks.active=true and done=false
            GROUP BY tblTasks.id, tbltasks.assoc_id, title, descr, obs, due_date, tblAssociations.logo
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
        SELECT tblTasks.id, vol_id, LEFT(tblVolunteers.nume,1) || LEFT(tblVolunteers.prenume,1) as initials, tblTasks.assoc_id, sum(hours_worked) as hours, profile_pic
        FROM tblTasks 
        LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
		LEFT JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id
		LEFT JOIN tblVolunteers ON tblVolAssoc.vol_id=tblVolunteers.id
		WHERE tblTasks.assoc_id=1
        GROUP BY tblTasks.id, vol_id, tblVolunteers.nume, tblVolunteers.prenume , tblTasks.assoc_id, profile_pic
        ")) {
        echo "View vActivityEnrolledVolunteers created!<br>";
    } else {
        echo "View vActivityEnrolledVolunteers failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */
function dropViewMyAssociationActivity($conn)
{
    try {

        pg_query($conn, 'DROP VIEW vMyAssociationActivity;');
        echo 'View vMyAssociationActivity dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vMyAssociationActivity: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewMyAssociationActivity($conn)
{
    if (pg_query($conn, "CREATE VIEW vMyAssociationActivity AS
        select tblvolunteers.id, tblvolunteers.nume || ' ' || tblvolunteers.prenume AS nume_prenume, tblVolAssoc.assoc_id, tblTasks.id as task_id, tbltasks.hours_worked, tbltasks.updated_on
            FROM tbltasks
            INNER JOIN tblActivity ON tblTasks.id=tblActivity.task_id
			INNER JOIN tblProjects ON tblTasks.proj_id=tblProjects.id
            INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblProjects.assoc_id
            INNER JOIN tblVolunteers ON tblvolunteers.id=tblVolAssoc.vol_id
			INNER JOIN tblAssociations ON tblProjects.assoc_id=tblAssociations.id
            WHERE done=true
            GROUP BY tblTasks.id, tblvolunteers.id, tblVolAssoc.assoc_id, tblVolunteers.nume, tblVolunteers.prenume, tbltasks.hours_worked
		ORDER BY nume_prenume ASC
        ")) {
        echo "View vMyAssociationActivity created!<br>";
    } else {
        echo "View vMyAssociationActivity failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */
