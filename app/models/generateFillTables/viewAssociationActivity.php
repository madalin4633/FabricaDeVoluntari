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
            select tblProjects.assoc_id, tblProjects.id as proj_id, tblTasks.id as task_id, tblAssociations.logo, tblTasks.title, tblTasks.descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tblAssociations 
			INNER JOIN tblProjects ON tblAssociations.id=tblProjects.assoc_id
			LEFT JOIN tblTasks ON tblProjects.id=tblTasks.proj_id
            LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
            LEFT JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblProjects.assoc_id
            WHERE tblProjects.active=true
            GROUP BY tblTasks.id, tblProjects.id, tblProjects.assoc_id, tblTasks.title, tblTasks.descr, obs, due_date, tblAssociations.logo
			ORDER BY tblProjects.assoc_id ASC, tblProjects.id ASC, tblTasks.id ASC
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
        SELECT tblProjects.id as proj_id, tblTasks.id as task_id, vol_id, LEFT(tblVolunteers.nume,1) || LEFT(tblVolunteers.prenume,1) as initials, tblProjects.assoc_id, sum(hours_worked) as hours, done,  profile_pic
        FROM tblTasks 
        LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
        LEFT JOIN tblProjects ON tblTasks.proj_id=tblProjects.id
		LEFT JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id
		LEFT JOIN tblVolunteers ON tblVolAssoc.vol_id=tblVolunteers.id
        GROUP BY tblProjects.id, tblTasks.id, vol_id, tblVolunteers.nume, tblVolunteers.prenume , tblProjects.assoc_id, profile_pic
        ")) {
        echo "View vActivityEnrolledVolunteers created!<br>";
    } else {
        echo "View vActivityEnrolledVolunteers failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

