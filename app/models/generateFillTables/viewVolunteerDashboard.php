<?php

/**
 *   View (DB) pentru dashboard user profile
 */

function dropViewVolunteerDashboard($conn)
{
    try {

        pg_query($conn, 'DROP VIEW vVolunteerDashboard;');
        echo 'View vVolunteerDashboard dropped.<br>';
        
        dropViewVolunteerDashboard_Feedback($conn);
        dropViewVolunteerDashboard_Bonus($conn);
    } catch (Exception $e) {
        echo 'Failed to drop view vVolunteerDashboard: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewVolunteerDashboard($conn)
{
    createViewVolunteerDashboard_Bonus($conn);
    createViewVolunteerDashboard_Feedback($conn);

    if (pg_query($conn, 'CREATE VIEW vVolunteerDashboard AS
    SELECT vVolunteerDashboardFeedback.vol_id, vVolunteerDashboardFeedback.assoc_id, vVolunteerDashboardFeedback.nume, logo, hours_worked, bonus, rating 
                FROM vVolunteerDashboardBonus
                INNER JOIN vVolunteerDashboardFeedback ON vVolunteerDashboardFeedback.vol_id=vVolunteerDashboardBonus.vol_id AND vVolunteerDashboardFeedback.assoc_id=vVolunteerDashboardBonus.assoc_id
                  ')) {
        echo "View vVolunteerDashboard created!<br>";
    } else {
        echo "View vVolunteerDashboard failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

function dropViewVolunteerDashboard_Feedback($conn)
{
    try {
        pg_query($conn, 'DROP VIEW vVolunteerDashboardFeedback;');
        echo 'View vVolunteerDashboardFeedback dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vVolunteerDashboardFeedback: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewVolunteerDashboard_Feedback($conn)
{
    if (pg_query($conn, 'CREATE VIEW vVolunteerDashboardFeedback AS
    SELECT vol_id, tblVolAssoc.assoc_id, nume, logo
                , (AVG(' . METRIC1 .') 
                + AVG(' . METRIC2 .')
                + AVG(' . METRIC3 .') 
                + AVG(' . METRIC4 .')
                + AVG(' . METRIC5 .'))/5 AS rating 
                FROM tblAssociations INNER JOIN tblVolAssoc ON tblAssociations.id = tblVolAssoc.assoc_id
                LEFT JOIN tblProjects ON tblProjects.assoc_id=tblVolAssoc.assoc_id
                LEFT JOIN tblTasks ON tblTasks.proj_id=tblProjects.id
                LEFT JOIN tblFeedback ON tblFeedback.task_id=tblTasks.id AND tblFeedback.volassoc_id = tblVolAssoc.id
                WHERE tblVolAssoc.active=true
                GROUP BY vol_id, tblVolAssoc.assoc_id, nume, logo
                  ')) {
        echo "View vVolunteerDashboardFeedback created!<br>";
    } else {
        echo "View vVolunteerDashboardFeedback failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

function dropViewVolunteerDashboard_Bonus($conn)
{
    try {
        pg_query($conn, 'DROP VIEW vVolunteerDashboardBonus;');
        echo 'View vVolunteerDashboardBonus dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vVolunteerDashboardBonus: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewVolunteerDashboard_Bonus($conn)
{
    if (pg_query($conn, 'CREATE VIEW vVolunteerDashboardBonus AS
SELECT tblVolAssoc.vol_id, tblVolAssoc.assoc_id, nume
                , SUM(bonus) as bonus,
                SUM(hours_worked) AS hours_worked  
                FROM tblAssociations INNER JOIN tblVolAssoc ON tblAssociations.id = tblVolAssoc.assoc_id
                LEFT JOIN tblProjects ON tblProjects.assoc_id=tblVolAssoc.assoc_id
                LEFT JOIN tblTasks ON tblTasks.proj_id=tblProjects.id
                LEFT JOIN tblActivity ON tblActivity.task_id=tblTasks.id AND tblActivity.volassoc_id = tblVolAssoc.id
                WHERE tblVolAssoc.active=true
                GROUP BY tblVolAssoc.vol_id, tblVolAssoc.assoc_id, nume
                  ')) {
        echo "View vVolunteerDashboardBonus created!<br>";
    } else {
        echo "View vVolunteerDashboardBonus failed! :" . pg_last_error($conn) . "<br>";
    }
}

