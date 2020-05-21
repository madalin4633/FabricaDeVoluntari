<?php

/**
 *      Feedback pentru voluntari
 */

function dropTableFeedback($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblFeedback;');
        echo 'Table tblFeedback dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblFeedback: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableFeedback($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblFeedback(
        id INTEGER,
        task_id INTEGER NOT NULL, /*fkey*/
        volassoc_id INTEGER NOT NULL, /*fkey*/
        ' . METRIC1 .' INTEGER CHECK(' . METRIC1 .' <=5), CHECK(' . METRIC1 .' >=0),
        ' . METRIC2 .' INTEGER CHECK(' . METRIC2 .' <=5), CHECK(' . METRIC2 .' >=0),
        ' . METRIC3 .' INTEGER CHECK(' . METRIC3 .' <=5), CHECK(' . METRIC3 .' >=0),
        ' . METRIC4 .' INTEGER CHECK(' . METRIC4 .' <=5), CHECK(' . METRIC4 .' >=0),
        ' . METRIC5 .' INTEGER CHECK(' . METRIC5 .' <=5), CHECK(' . METRIC5 .' >=0),

        descriere TEXT,
        for_Volunteer BOOLEAN DEFAULT TRUE,' . /* if FALSE, it is for Association */
        'created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        CONSTRAINT feed_task_fkey FOREIGN KEY (task_id)
        REFERENCES tblTasks(id),
        CONSTRAINT feed_volassoc_fkey FOREIGN KEY (volassoc_id)
        REFERENCES tblVolAssoc(id)
        )  ')) {
        echo "Table Feedback created!<br>";
    } else {
        echo "Table Feedback failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

/**
 * Insert random data
 */

function insertDataFeedback($conn)
{
    for ($xi = 0; $xi < HOW_MANY_ASSOC * HOW_MANY_VOL; $xi++) {
        for ($task = 0; $task < HOW_MANY_TASKS; $task++) {
        insert_Feedback($conn, $xi, $task);
        }
    }
}

/**
 * Insert test data in tblFeedback (with low probability)
 */
function insert_Feedback($conn, $task, $volassoc)
{
    for ($i = 1; $i < 5; $i++) {
        if (rand(0, 100) < 29) {                     /* % probabilitate ca voluntarul sa aiba feedback */
            $query  ='INSERT INTO tblFeedback 
        (id, task_id, volassoc_id , ' . METRIC1 .',  ' . METRIC2 .',  ' . METRIC3 .',  ' . METRIC4 .',  ' . METRIC5 .', created_on, updated_on) VALUES 
        (' . $task . ',' . $task . ',' . $volassoc . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) .', current_timestamp, current_timestamp)';

            try {
                if (pg_query($conn, $query)) {
                    echo "Record added in tblFeedback";
                }
            } catch (Exception $e) {
                // echo $e->getMessage();
            }
        }
    }
}
