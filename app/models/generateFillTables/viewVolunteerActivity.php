<?php

/**
 *   View (DB) pentru user activity
 */

function dropViewVolunteerActivity($conn)
{
    try {

        pg_query($conn, 'DROP VIEW vVolunteerActivity;');
        echo 'View vVolunteerDashboard dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vVolunteerActivity: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewVolunteerActivity($conn)
{
    if (pg_query($conn, "CREATE VIEW vVolunteerActivity AS
            select tblTasks.id as task_id, vol_id, tblVolAssoc.assoc_id, tblAssociations.logo, tblTasks.title, tblTasks.descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tbltasks 
            INNER JOIN tblActivity ON tblTasks.id=tblActivity.task_id
			INNER JOIN tblProjects ON tblTasks.proj_id=tblProjects.id
            INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblProjects.assoc_id
            INNER JOIN tblAssociations ON tblProjects.assoc_id=tblAssociations.id
            WHERE tblTasks.active=true and done=false
            GROUP BY tblTasks.id, vol_id, tblVolAssoc.assoc_id, tblTasks.title, tblTasks.descr, obs, due_date, tblAssociations.logo
                  ")) {
        echo "View vVolunteerActivity created!<br>";
    } else {
        echo "View vVolunteerActivity failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

function dropViewVolunteerNewTasks($conn)
{
    try {

        pg_query($conn, 'DROP VIEW vVolunteerNewTasks;');
        echo 'View vVolunteerNewTasks dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vVolunteerNewTasks: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewVolunteerNewTasks($conn)
{
    if (pg_query($conn, "CREATE VIEW vVolunteerNewTasks AS
            select count(volassoc_id) as vol_enrolled, tblTasks.id as task_id, max_volunteers, tblProjects.assoc_id, tblTasks.title, tblTasks.descr, obs, logo as assoclogo, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tblTasks 
			INNER JOIN tblProjects ON tblTasks.proj_id=tblProjects.id
            LEFT JOIN  tblAssociations ON tblProjects.assoc_id=tblAssociations.id 
			LEFT JOIN tblActivity ON tblActivity.task_id=tblTasks.id
            WHERE tblTasks.active=true and done=false
			GROUP BY tblTasks.id, max_volunteers, tblProjects.assoc_id, tblTasks.title, obs, logo ,due_date
                  ")) {
        echo "View vVolunteerNewTasks created!<br>";
    } else {
        echo "View vVolunteerNewTasks failed! :" . pg_last_error($conn) . "<br>";
    }
}

