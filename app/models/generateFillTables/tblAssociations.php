<?php

/**
 *          Asociatii
 */

function dropTableAssociations($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblAssociations;');
        echo 'Table tblAssociations dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblAssociations: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableAssociations($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblAssociations(
        id serial PRIMARY KEY,
        nume VARCHAR(50) NOT NULL,
        adresa VARCHAR(50),
        logo VARCHAR(64),
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

/***    ================================================================================================================== */

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

    for ($xi = 0; $xi < HOW_MANY_ASSOC; $xi++) {
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $data = json_decode($response, true);

        insert_Assoc(
            $conn,
            $data['results'][0]['location']['city'] . " " . $orgNameSuffix[array_rand($orgNameSuffix)],
            implode($data['results'][0]['location']['street'], " ") . ", " . $data['results'][0]['location']['state'],
            $data['results'][0]['email'],
            '\'assoc_' . strval($xi+1) . '.jpg\''
        );
    }
    
    curl_close($curl);
}

/**
 * Insert test data in tblAssociations
 */
function insert_Assoc($conn, $nume, $adresa, $email, $logo)
{
    $query  ='INSERT INTO tblAssociations 
    (nume, adresa, email, logo, created_on, updated_on) VALUES 
    (' . pg_escape_literal($nume) . ',' . pg_escape_literal($adresa) . ',' . pg_escape_literal($email) . ',' . $logo . ', current_timestamp, current_timestamp)';

    echo $query . '<br>';

    if (pg_query($conn, $query)) {
        echo "Record added in tblAssociations";
    }
}

