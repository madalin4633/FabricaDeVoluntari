<?php

/**
 *          tabel de asociere intre voluntari si asociatii
 */

function dropTableVolAssoc($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblVolAssoc;');
        echo 'Table tblVolAssoc dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblVolAssoc: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableVolAssoc($conn)
{
    // asociere intre asociatii si voluntari
    if (pg_query($conn, 'CREATE TABLE tblVolAssoc(
        id serial UNIQUE,
        vol_id INTEGER NOT NULL, /*fkey*/
        assoc_id INTEGER NOT NULL, /*fkey*/
        active BOOLEAN NOT NULL DEFAULT TRUE,      /* volunteer - association relationship is active? When a volunteer stops working
                                                        for an association (active set to false), its history will be preserved */
        -- hours_worked INTEGER,
        -- bonus_points INTEGER,                      /* little hearts received for small tasks */
        /*rating_id serial UNIQUE,                    used as foreign key in tblFeedback */
        created_on TIMESTAMP NOT NULL,
        PRIMARY KEY (vol_id, assoc_id),
        CONSTRAINT volassoc_vol_fkey FOREIGN KEY (vol_id)
        REFERENCES tblVolunteers(id),
        CONSTRAINT volassoc_assoc_fkey FOREIGN KEY (assoc_id)
        REFERENCES tblAssociations(id)
    )  ')) {
        echo "Table VolAssoc created!<br>";
    } else {
        echo "Table VolAssoc failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

/**
 * Insert random data
 */

function insertDataVolAssoc($conn)
{
    for ($xi = 1; $xi <= HOW_MANY_ASSOC; $xi++) { // associatii
        for ($yi = 1; $yi <= HOW_MANY_VOL; $yi++) { // voluntari
            insert_VolAssoc($conn, $yi, $xi);
        }
    }
}

/**
 * Insert test data in tblVolAssoc (with low probability)
 */
function insert_VolAssoc($conn, $assoc, $vol)
{
    if (rand(0, 100) < 9) {                     /* 9% probabilitate ca voluntarul $vol sa lucreze la asociatia $assoc */
        $query  ='INSERT INTO tblVolAssoc 
        (assoc_id, vol_id, created_on) VALUES 
        (' . $assoc . ',' . $vol .', current_timestamp)';

        try {
            if (pg_query($conn, $query)) {
                echo "Record added in tblVolAssoc";
            }
        } catch (Exception $e) {
            // echo $e->getMessage();
        }
    }
}
