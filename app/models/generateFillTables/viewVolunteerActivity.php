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
            select tblProjects.id as proj_id, tblProjects.title as proj_title, tblProjects.descr as proj_descr, tblTasks.id as task_id, vol_id, tblVolAssoc.assoc_id, tblVolAssoc.id as volassoc_id, tblAssociations.logo as assoclogo, tblTasks.title, tblTasks.descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tbltasks 
            INNER JOIN tblActivity ON tblTasks.id=tblActivity.task_id
			INNER JOIN tblProjects ON tblTasks.proj_id=tblProjects.id
            INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblProjects.assoc_id
            INNER JOIN tblAssociations ON tblProjects.assoc_id=tblAssociations.id
            WHERE tblTasks.active=true and tblActivity.done=false
            GROUP BY tblProjects.id, tblProjects.title, tblProjects.descr, tblTasks.id, vol_id, tblVolAssoc.assoc_id, tblTasks.title, tblTasks.descr, obs, due_date, tblAssociations.logo
                  ")) {
        echo "View vVolunteerActivity created!<br>";
    } else {
        echo "View vVolunteerActivity failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

function dropViewVolunteerCompleted($conn)
{
    try {

        pg_query($conn, 'DROP VIEW vVolunteerCompleted;');
        echo 'View vVolunteerCompleted dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vVolunteerCompleted: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewVolunteerCompleted($conn)
{
    if (pg_query($conn, "CREATE VIEW vVolunteerCompleted AS
            select tblProjects.id as proj_id, tblProjects.title as proj_title, tblProjects.descr as proj_descr, tblTasks.id as task_id, vol_id, tblVolAssoc.assoc_id, tblVolAssoc.id as volassoc_id, tblAssociations.logo as assoclogo, tblTasks.title, tblTasks.descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tbltasks 
            INNER JOIN tblActivity ON tblTasks.id=tblActivity.task_id
			INNER JOIN tblProjects ON tblTasks.proj_id=tblProjects.id
            INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblProjects.assoc_id
            INNER JOIN tblAssociations ON tblProjects.assoc_id=tblAssociations.id
            WHERE tblTasks.active=true and tblActivity.done=true
            GROUP BY tblProjects.id, tblProjects.title, tblProjects.descr, tblTasks.id, vol_id, tblVolAssoc.assoc_id, tblTasks.title, tblTasks.descr, obs, due_date, tblAssociations.logo
                  ")) {
        echo "View vVolunteerCompleted created!<br>";
    } else {
        echo "View vVolunteerCompleted failed! :" . pg_last_error($conn) . "<br>";
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
        SELECT tblProjects.id as proj_id, tblProjects.title as proj_title, tblProjects.descr as proj_descr, tblVolAssoc.vol_id, tblVolAssoc.id as volassoc_id, tblTasks.id as task_id, tblVolAssoc.assoc_id, tblTasks.title, tblTasks.descr, tblTasks.obs, hours_worked, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date, logo as assoclogo, tblTasks.done as task_done, tAct.vol_id as enrolled_id
        FROM tblVolAssoc
        INNER JOIN tblAssociations ON tblAssociations.id = tblVolAssoc.assoc_id
        INNER JOIN tblProjects ON tblProjects.assoc_id = tblAssociations.id
        INNER JOIN tblTasks ON tblTasks.proj_id = tblProjects.id
        LEFT JOIN (SELECT * FROM tblActivity INNER JOIN tblVolAssoc ON tblActivity.volassoc_id=tblVolAssoc.id) tAct ON tAct.task_id = tblTasks.id 
        where tblProjects.active = true 
                  ")) {
        echo "View vVolunteerNewTasks created!<br>";
    } else {
        echo "View vVolunteerNewTasks failed! :" . pg_last_error($conn) . "<br>";
    }
}

