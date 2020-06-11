<?php

/**
 *          Activitati in asociatie (gen numar de ore lucrate per task, aprecieri)
 */

function dropTableBadgr($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblBadgr;');
        echo 'Table tblBadgr dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblBadgr: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableBadgr($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblBadgr(
        id INTEGER,
        access_token VARCHAR(200),
        refresh_token VARCHAR(200)
        )  ')) {
        echo "Table Badgr created!<br>";
    } else {
        echo "Table tblBadgr failed! :" . pg_last_error($conn) . "<br>";
    }
}
?>