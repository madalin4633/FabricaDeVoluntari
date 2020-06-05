<?php

/**
 *          Projects
 */

function dropTableProjects($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblProjects;');
        echo 'Table tblProjects dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblProjects: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableProjects($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblProjects(
        id serial PRIMARY KEY,
        assoc_id INTEGER NOT NULL, /*fkey*/
        title VARCHAR(200) NOT NULL,
        descr TEXT NOT NULL,
        active BOOLEAN DEFAULT TRUE,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        CONSTRAINT task_assoc_fkey FOREIGN KEY (assoc_id)
        REFERENCES tblAssociations(id)
        )  ')) {
        echo "Table Projects created!<br>";
    } else {
        echo "Table tblProjects failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

/**
 * insert random data
 */
function insertDataProjects($conn)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://taco-randomizer.herokuapp.com/random/?full-taco=true");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    for ($xi = 0; $xi < HOW_MANY_ASSOC; $xi++) {
        for ($task = 0; $task < HOW_MANY_PROJECTS; $task++) {
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $data = json_decode($response, true);

            insert_Project(
                $conn,
                $xi + 1, /* assoc_id */
                $data['name'], /*title*/
                $data['base_layer']['recipe'], /*desc*/
            );
        }
    }
    
    curl_close($curl);
}

/**
 * Insert test data in tblProjects
 */
function insert_Project($conn, $assoc_id, $title, $desc)
{
    if (rand(0, 100) < 40) {
        $query  ='INSERT INTO tblProjects 
    (assoc_id, title, descr, created_on, updated_on) VALUES 
    (' . $assoc_id . ','
      . pg_escape_literal($title)
      . ',' . pg_escape_literal($desc)
      . ',NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\', 
      NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\')';

        echo $query . '<br>';

        try {
            if (pg_query($conn, $query)) {
                echo "Record added in tblProjects";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
