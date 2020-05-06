<?php
/**
 * Model for api calls:
 * POST api/createTables/ => createTables()
 * POST api/createTables/Associations => createTableAssoc()
 * POST api/createTables/Volunteers => createTableVolunteers()
 * POST api/createTables/VolAssoc => createTableVolAssoc()
 *
 * 
 * DELETE api/createTables/Associations => dropTableAssoc()
 * DELETE api/createTables/Volunteers => dropTableVolunteers()
 * DELETE api/createTables/VolAssoc => dropTableVolAssoc()
 *
 * PUT api/createTables/Associations => insertDataAssociations()
 * PUT api/createTables/Volunteers => insertDataVolunteers()
 * PUT api/createTables/VolAssoc => insertDataVolAssoc()
 *
 */


/**
 * called from api/createTables (admin only)
 */
function createTables($conn)
{
    dropTableVolAssoc($conn);
    dropTableVolunteers($conn);
    dropTableAssociations($conn);

    createTableVolunteers($conn);
    createTableAssociations($conn);
    createTableVolAssoc($conn);
}

function dropTableVolAssoc($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblVolAssoc;');
        echo 'Table tblVolAssoc dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblVolAssoc: ' . $e->getMessage() . '<br>';
    }
}

function createTableVolAssoc($conn)
{
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
        echo "Table VolAssoc created!<br>";
    } else {
        echo "Table VolAssoc failed! :" . pg_last_error($conn) . "<br>";
    }
}

function dropTableVolunteers($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblVolunteers;');
        echo 'Table tblVolunteers dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblVolunteers: ' . $e->getMessage() . '<br>';
    }
}

function createTableVolunteers($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblVolunteers(
        id serial PRIMARY KEY,
        nume VARCHAR(50) NOT NULL,
        prenume VARCHAR(50) NOT NULL,
        email VARCHAR (355) UNIQUE NOT NULL,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        last_login TIMESTAMP
        )  ')) {
        echo "Table Volunteers created!<br>";
    } else {
        echo "Table Volunteers failed! :" . pg_last_error($conn) . "<br>";
    }
}

function dropTableAssociations($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblAssociations;');
        echo 'Table tblAssociations dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblAssociations: ' . $e->getMessage() . '<br>';
    }
}

function createTableAssociations($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblAssociations(
        id serial PRIMARY KEY,
        nume VARCHAR(50) NOT NULL,
        adresa VARCHAR(50),
        email VARCHAR (355) UNIQUE NOT NULL,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        last_login TIMESTAMP
        )  ')) {
        echo "Table Associations created!<br>";
    } else {
        echo "Table tblAssociations failed! :" . pg_last_error($conn) . "<br>";
    }
}

/**
 * insert random data
 */
function insertDataAssociations($conn)
{
    echo "<b>Warnings are due to unique constraint on email, so it's fine!</b>      <br><br>";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://randomuser.me/api/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    $orgNameSuffix = array("Charity", "Volunteers", "Organization", "for the People", "United");

    for ($xi = 0; $xi < 12; $xi++) {
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $data = json_decode($response, true);

        insert_Assoc(
            $conn,
            $data['results'][0]['location']['city'] . " " . $orgNameSuffix[array_rand($orgNameSuffix)],
            implode($data['results'][0]['location']['street'], " ") . ", " . $data['results'][0]['location']['state'],
            $data['results'][0]['email']
        );
    }
    
    curl_close($curl);
}

function insertDataVolunteers($conn)
{
    echo "<b>Warnings are due to unique constraint on email, so it's fine!</b>      <br><br>";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://randomuser.me/api/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    $orgNameSuffix = array("Charity", "Volunteers", "Organization", "for the People", "United");

    for ($xi = 0; $xi < 10; $xi++) {
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $data = json_decode($response, true);

        insert_Volunteers(
            $conn,
            $data['results'][0]['name']['last'],
            $data['results'][0]['name']['first'],
            $data['results'][0]['email']
        );
    }

    
    curl_close($curl);
}

/**
 * Insert random data
 */
function insertDataVolAssoc($conn)
{
    for ($xi = 1; $xi <= 12; $xi++) { // associatii
        for ($yi = 1; $yi <= 20; $yi++) { // voluntari
            insert_VolAssoc($conn, $yi, $xi);
        }
    }
}

/**
 * Insert test data in tblAssociations
 */
function insert_Assoc($conn, $nume, $adresa, $email)
{
    $query  ='INSERT INTO tblAssociations 
    (nume, adresa, email, created_on, updated_on) VALUES 
    (\'' . $nume . '\',\'' . $adresa . '\',\'' . $email . '\', current_timestamp, current_timestamp)';

    echo $query . '<br>';

    if (pg_query($conn, $query)) {
        echo "Record added in tblAssociations";
    }
}

/**
 * Insert test data in tblVolAssoc (with low probability)
 */
function insert_VolAssoc($conn, $assoc, $vol)
{
    if (rand(0, 100) < 9) {
        $query  ='INSERT INTO tblVolAssoc 
        (assoc_id, vol_id, created_on) VALUES 
        (' . $assoc . ',' . $vol .', current_timestamp)';

        if (pg_query($conn, $query)) {
            echo "Record added in tblVolAssoc";
        }
    }
}

/**
 * Insert test data in tblVolunteers
 */
function insert_Volunteers($conn, $nume, $prenume, $email)
{
    $query  ='INSERT INTO tblVolunteers 
    (nume, prenume, email, created_on, updated_on) VALUES 
    (\'' . $nume . '\',\'' . $prenume . '\',\'' . $email . '\', current_timestamp, current_timestamp)';

    echo $query . '<br>';

    if (pg_query($conn, $query)) {
        echo "Record added in tblVolunteers";
    }
}
