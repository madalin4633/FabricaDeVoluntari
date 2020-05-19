<?php

/**
 *          Activitati in asociatie (gen numar de ore lucrate per task, aprecieri)
 */

function dropTableActivity($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblActivity;');
        echo 'Table tblActivity dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblActivity: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableActivity($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblActivity(
        id serial PRIMARY KEY,
        task_id INTEGER NOT NULL, /*fkey*/
        volassoc_id INTEGER NOT NULL, /*fkey*/
        hours_worked INTEGER,               /* hours worked each day*/
        bonus INTEGER DEFAULT 0,            /* little hearts received for small tasks */
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        CONSTRAINT act_task_fkey FOREIGN KEY (task_id)
        REFERENCES tblTasks(id),
        CONSTRAINT act_volassoc_fkey FOREIGN KEY (volassoc_id)
        REFERENCES tblVolAssoc(id)
        )  ')) {
        echo "Table Activity created!<br>";
    } else {
        echo "Table tblActivity failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

/**
 * insert random data
 */
function insertDataActivity($conn)
{
    for ($xi = 0; $xi < HOW_MANY_ASSOC * HOW_MANY_VOL; $xi++) {
        for ($task = 0; $task < HOW_MANY_TASKS; $task++)
            for ($yi = 0; $yi < 6; $yi++) {
            insert_Activity(
                $conn,
                $xi+1,
                $task+1,
                rand(3, 10),
                (rand(0, 100)<35) ? 1: 0
            );
        }
    }
    
    curl_close($curl);
}

/**
 * Insert test data in tblActivity
 */
function insert_Activity($conn, $task_id, $volassoc_id, $hours, $bonus)
{
    if (rand(0, 100) < 50) {
        $query  ='INSERT INTO tblActivity 
    (task_id, volassoc_id, hours_worked, bonus, created_on, updated_on) VALUES 
    (' . $task_id . ',' .
      $volassoc_id . ',' .
      $hours . ',' .
      $bonus . ',' .
      'current_timestamp, current_timestamp)';

        echo $query . '<br>';

        try {
            if (pg_query($conn, $query)) {
                echo "Record added in tblActivity";
            }
        } catch (Exception $e) {
            // echo $e->getMessage();
        }
    }
}
