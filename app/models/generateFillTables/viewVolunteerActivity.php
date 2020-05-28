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
            select tblTasks.id as task_id, vol_id, tblVolAssoc.assoc_id, tblAssociations.logo, title, descr, obs, sum(hours_worked) as hours_worked, sum(bonus) as bonus, TO_CHAR(due_date, 'DD-MM-YYYY') as due_date
            from tbltasks 
            INNER JOIN tblActivity ON tblTasks.id=tblActivity.task_id
            INNER JOIN tblVolAssoc ON tblVolAssoc.id=tblActivity.volassoc_id AND tblVolAssoc.assoc_id=tblTasks.assoc_id
            INNER JOIN tblAssociations ON tblTasks.assoc_id=tblAssociations.id
            WHERE tblTasks.active=true and done=false
            GROUP BY tblTasks.id, vol_id, tblVolAssoc.assoc_id, title, descr, obs, due_date, tblAssociations.logo
                  ")) {
        echo "View vVolunteerActivity created!<br>";
    } else {
        echo "View vVolunteerActivity failed! :" . pg_last_error($conn) . "<br>";
    }
}

