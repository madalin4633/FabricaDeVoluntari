<?php

function createTables($conn) {
    try {
        pg_query($conn, 'DROP TABLE tblVolAssoc; DROP TABLE tblVolunteers; DROP TABLE tblAssociations;');
    } catch (Exception $e) {
        echo 'Failed to drop tables: ' . $e->getMessage() . '\n';
    }

    if (pg_query($conn, 'CREATE TABLE tblVolunteers(
        id serial PRIMARY KEY,
        nume VARCHAR(50) NOT NULL,
        prenume VARCHAR(50) NOT NULL,
        email VARCHAR (355) UNIQUE NOT NULL,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        last_login TIMESTAMP
        )  ')) {
        echo "Table Volunteers created!\n";
    }

    if (pg_query($conn, 'CREATE TABLE tblAssociations(
        id serial PRIMARY KEY,
        nume VARCHAR(50) NOT NULL,
        adresa VARCHAR(50),
        email VARCHAR (355) UNIQUE NOT NULL,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        last_login TIMESTAMP
        )  ')) {
        echo "Table Associations created!\n";
    }

    // asociere intre asociatii si voluntari
    if (pg_query($conn, 'CREATE TABLE tblVolAssoc(
        vol_id INTEGER NOT NULL,
        assoc_id INTEGER NOT NULL,
        created_on TIMESTAMP NOT NULL,
        PRIMARY KEY (vol_id, assoc_id),
        CONSTRAINT volassoc_vol_fkey FOREIGN KEY (vol_id)
        REFERENCES tblVolunteers(id),
        CONSTRAINT volassoc_assoc_fkey FOREIGN KEY (assoc_id)
        REFERENCES tblAssociations(id)
        )  ')) {
        echo "Table VolAssoc created!\n";
    }

}