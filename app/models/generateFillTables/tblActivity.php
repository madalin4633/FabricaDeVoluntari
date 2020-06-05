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
        for ($task = 0; $task < HOW_MANY_TASKS; $task++) {
            insert_Activity(
                $conn,
                $xi+1,
                $task+1
            );
        }
    }
    
    curl_close($curl);
}

/**
 * Insert test data in tblActivity
 */
function insert_Activity($conn, $task_id, $volassoc_id)
{
    if (rand(0, 100) < 50) {
        $query  ='INSERT INTO tblActivity 
    (task_id, volassoc_id, created_on, updated_on) VALUES 
    (' . $task_id . ',' .
      $volassoc_id . ',' .
      'NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\', 
      NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\')';

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
