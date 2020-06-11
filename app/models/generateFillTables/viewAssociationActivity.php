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
            select tblProjects.assoc_id, tblProjects.id as proj_id, tblTasks.id as task_id, tblAssociations.logo, tblTasks.title, tblTasks.descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, tblTasks.done as task_done, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tblAssociations 
			INNER JOIN tblProjects ON tblAssociations.id=tblProjects.assoc_id
			LEFT JOIN tblTasks ON tblProjects.id=tblTasks.proj_id
            LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
            LEFT JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblProjects.assoc_id
            WHERE tblProjects.active=true
            GROUP BY tblTasks.done, tblTasks.id, tblProjects.id, tblProjects.assoc_id, tblTasks.title, tblTasks.descr, obs, due_date, tblAssociations.logo
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
        SELECT tblProjects.id as proj_id, tblTasks.id as task_id, tblActivity.volassoc_id, vol_id, LEFT(tblVolunteers.nume,1) || LEFT(tblVolunteers.prenume,1) as initials, tblProjects.assoc_id, sum(hours_worked) as hours, tblTasks.done as task_done, tblActivity.done as activity_done,  profile_pic, 
		 tblFbVol.volHasFeedback, assocHasFeedback
        FROM tblTasks 
        LEFT JOIN tblActivity ON tblTasks.id=tblActivity.task_id
        LEFT JOIN tblProjects ON tblTasks.proj_id=tblProjects.id
		LEFT JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id
		LEFT JOIN tblVolunteers ON tblVolAssoc.vol_id=tblVolunteers.id 
		LEFT JOIN (SELECT true as volHasFeedback, volassoc_id, task_id FROM tblFeedback WHERE for_volunteer = true ) tblFbVol ON tblFbVol.volassoc_id = tblActivity.volassoc_id AND tblFbVol.task_id = tblTasks.id
		LEFT JOIN (SELECT true as assocHasFeedback, volassoc_id, task_id FROM tblFeedback WHERE for_volunteer = false ) tblFbAssoc ON tblFbAssoc.volassoc_id = tblActivity.volassoc_id AND tblFbAssoc.task_id = tblTasks.id
        GROUP BY tblProjects.id, tblActivity.volassoc_id, tblTasks.id, vol_id, tblVolunteers.nume, tblVolunteers.prenume , tblProjects.assoc_id, profile_pic, tblFbVol.volHasFeedback, assocHasFeedback, tblActivity.done
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
            WHERE tblTasks.done=true
            GROUP BY tblTasks.id, tblvolunteers.id, tblVolAssoc.assoc_id, tblVolunteers.nume, tblVolunteers.prenume, tbltasks.hours_worked
		ORDER BY nume_prenume ASC
        ")) {
        echo "View vMyAssociationActivity created!<br>";
    } else {
        echo "View vMyAssociationActivity failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */
