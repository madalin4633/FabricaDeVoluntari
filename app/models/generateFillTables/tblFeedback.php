<?php

/**
 *      Feedback pentru voluntari
 */

define ("METRIC1","harnic");
define ("METRIC2","comunicativ");
define ("METRIC3","disponibil");
define ("METRIC4","punctual");
define ("METRIC5","saritor");

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
        ' . METRIC1 .' INTEGER CHECK(' . METRIC1 .' <=5), CHECK(' . METRIC1 .' >=0),
        ' . METRIC2 .' INTEGER CHECK(' . METRIC2 .' <=5), CHECK(' . METRIC2 .' >=0),
        ' . METRIC3 .' INTEGER CHECK(' . METRIC3 .' <=5), CHECK(' . METRIC3 .' >=0),
        ' . METRIC4 .' INTEGER CHECK(' . METRIC4 .' <=5), CHECK(' . METRIC4 .' >=0),
        ' . METRIC5 .' INTEGER CHECK(' . METRIC5 .' <=5), CHECK(' . METRIC5 .' >=0),

        descriere TEXT,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        CONSTRAINT feedback_fkey FOREIGN KEY (id)
        REFERENCES tblVolAssoc(rating_id)
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
    for ($xi = 1; $xi <= HOW_MANY_ASSOC; $xi++) { // associatii
        // for ($yi = 1; $yi <= HOW_MANY_VOL; $yi++) { // voluntari
            insert_Feedback($conn, $xi);
        // }
    }
}

/**
 * Insert test data in tblFeedback (with low probability)
 */
function insert_Feedback($conn, $rating_id)
{
    for ($i = 1; $i < 5; $i++) {
        if (rand(0, 100) < 9) {                     /* % probabilitate ca voluntarul sa aiba feedback */
            $query  ='INSERT INTO tblFeedback 
        (id, ' . METRIC1 .',  ' . METRIC2 .',  ' . METRIC3 .',  ' . METRIC4 .',  ' . METRIC5 .', created_on, updated_on) VALUES 
        (' . $rating_id . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) . ',' . strval(rand(0, 5)) .', current_timestamp, current_timestamp)';

            if (pg_query($conn, $query)) {
                echo "Record added in tblFeedback";
            }
        }
    }
}

