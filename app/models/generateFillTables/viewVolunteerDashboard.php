<?php

/**
 *   View (DB) pentru dashboard user profile
 */

function dropViewVolunteerDashboard($conn)
{
    try {
        pg_query($conn, 'DROP VIEW vVolunteerDashboard;');
        echo 'View vVolunteerDashboard dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop view vVolunteerDashboard: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createViewVolunteerDashboard($conn)
{
    if (pg_query($conn, 'CREATE VIEW vVolunteerDashboard AS
    SELECT vol_id, assoc_id, nume, logo, hours_worked, bonus_points
                , (AVG(' . METRIC1 .') 
                + AVG(' . METRIC2 .')
                + AVG(' . METRIC3 .') 
                + AVG(' . METRIC4 .')
                + AVG(' . METRIC5 .'))/5 AS rating 
                FROM tblAssociations INNER JOIN tblVolAssoc ON tblAssociations.id = tblVolAssoc.assoc_id
                LEFT JOIN tblFeedback ON tblFeedback.id=tblVolAssoc.rating_id
                WHERE active=true
                GROUP BY vol_id, assoc_id, nume, logo, hours_worked, bonus_points
                  ')) {
        echo "View vVolunteerDashboard created!<br>";
    } else {
        echo "View vVolunteerDashboard failed! :" . pg_last_error($conn) . "<br>";
    }
}

