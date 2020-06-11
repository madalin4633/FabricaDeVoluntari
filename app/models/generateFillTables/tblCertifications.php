<?php

/**
 *          Certifications
 */

function dropTableCertifications($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblCertifications;');
        echo 'Table tblCertifications dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblCertifications: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableCertifications($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblCertifications(
        id serial PRIMARY KEY,
        volassoc_id INTEGER NOT NULL, /*fkey*/
        drive_url VARCHAR(200) NOT NULL,
        active BOOLEAN DEFAULT TRUE,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        CONSTRAINT cert_volassoc_fkey FOREIGN KEY (volassoc_id)
        REFERENCES tblVolAssoc(id)
        )  ')) {
        echo "Table Certifications created!<br>";
    } else {
        echo "Table tblCertifications failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

/**
 * insert random data
 */
function insertDataCertifications($conn)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://taco-randomizer.herokuapp.com/random/?full-taco=true");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    for ($xi = 0; $xi < HOW_MANY_ASSOC; $xi++) {
        for ($task = 0; $task < HOW_MANY_Certifications; $task++) {
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $data = json_decode($response, true);

            insert_Certification(
                $conn,
                $xi + 1, /* assoc_id */
                $data['name'], /*title*/
                array_key_exists('condiment', $data) ? $data['condiment']['recipe'] : null, /*obs*/
                $data['base_layer']['recipe'], /*desc*/
            );
        }
    }
    
    curl_close($curl);
}

/**
 * Insert test data in tblCertifications
 */
function insert_Certification($conn, $assoc_id, $title, $obs, $desc)
{
    if (rand(0, 100) < 40) {
        $query  ='INSERT INTO tblCertifications 
    (assoc_id, title, descr, obs, created_on, updated_on, due_date) VALUES 
    (' . $assoc_id . ','
      . pg_escape_literal($title)
      . ',' . pg_escape_literal($desc)
      . ',' . pg_escape_literal($obs)
      . ',NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\', 
      NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\', 
      NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\')';

        echo $query . '<br>';

        try {
            if (pg_query($conn, $query)) {
                echo "Record added in tblCertifications";
            }
        } catch (Exception $e) {
            // echo $e->getMessage();
        }
    }
}
