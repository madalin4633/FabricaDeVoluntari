<?php

/**
 *      voluntari
 */


function dropTableVolunteers($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblVolunteers;');
        echo 'Table tblVolunteers dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblVolunteers: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

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

/***    ================================================================================================================== */

function insertDataVolunteers($conn)
{
    echo "<b>Warnings are due to unique constraint on email, so it's fine!</b>      <br><br>";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://randomuser.me/api/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    $orgNameSuffix = array("Charity", "Volunteers", "Organization", "for the People", "United");

    for ($xi = 0; $xi < HOW_MANY_VOL; $xi++) {
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
