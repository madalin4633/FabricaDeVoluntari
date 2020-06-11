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
        username VARCHAR(50) NOT NULL,
        data_nasterii DATE,
        gen VARCHAR(10),
        nationalitate VARCHAR(20),
        ocupatie VARCHAR(20), 
        studies VARCHAR(40),
        reason TEXT,
        email VARCHAR (355) UNIQUE NOT NULL,
        phone_no VARCHAR(16) NOT NULL,
        link_facebook VARCHAR(200),
        pass_hash VARCHAR(128) NOT NULL, /*sha512*/
        profile_pic VARCHAR(64),
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
            $data['results'][0]['phone'] ,
            $data['results'][0]['name']['last'] ,
            $data['results'][0]['name']['first'],
            $data['results'][0]['gender'],
            $data['results'][0]['nat'],
            $data['results'][0]['dob']['date'],
            $data['results'][0]['email'],
            'profile-pic-' . strval($xi+1) . '.jpg'
        );
    }

    
    curl_close($curl);
}

/**
 * Insert test data in tblVolunteers
 */
function insert_Volunteers($conn, $phone_no, $nume, $prenume, $gender, $nat, $dob, $email, $pic)
{
    $query  ='INSERT INTO tblVolunteers 
    (nume, prenume, phone_no, username, email, gen, nationalitate, data_nasterii, profile_pic, pass_hash, created_on, updated_on) VALUES 
    (' . pg_escape_literal($nume) . ',' . 
    pg_escape_literal($prenume) . ',' . 
    pg_escape_literal($phone_no) . ',' . 
    pg_escape_literal($prenume .  $nume) . ',' . 
    pg_escape_literal($email) . ',' . 
    pg_escape_literal($gender) . ',' . 
    pg_escape_literal($nat) . ',' . 
    pg_escape_literal($dob) . ',' . 
    pg_escape_literal($pic) . ', ' . 
    pg_escape_literal("9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0") . ',
    NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\', 
    NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\')';

    echo $query . '<br>';

    if (pg_query($conn, $query)) {
        echo "Record added in tblVolunteers";
    }
}
