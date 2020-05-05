<?php

/**
 * called from api/createTables (admin only)
 */
function createTables($conn) {
    try {
        pg_query($conn, 'DROP TABLE tblVolAssoc; DROP TABLE tblVolunteers; DROP TABLE tblAssociations;');
        echo 'Tables dropped. \n';
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

    insertData($conn);

}

function insertData($conn) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://randomuser.me/api/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    

    for ($xi = 0; $xi < 12; $xi++) {
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $data = json_decode($response, true);

        insert_Assoc($conn,  $data['results'][0]['location']['city'] . " Charity", 
            $data['results'][0]['location']['street']['name'], $data['results'][0]['email']);
    }
    curl_close($curl);
}

/**
 * Insert test data in tblAssociations
 */
function insert_Assoc($conn, $nume, $adresa, $email) {
    $query  ='INSERT INTO tblAssociations 
    (nume, adresa, email, created_on, updated_on) VALUES 
    (\'' . $nume . '\',\'' . $adresa . '\',\'' . $email . '\', current_timestamp, current_timestamp)';

    echo $query . '\n';

    if (pg_query($conn, $query)) { echo "Record added in tblAssociations";}
}