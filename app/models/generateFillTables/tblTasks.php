<?php

/**
 *          Task-uri
 */

function dropTableTasks($conn)
{
    try {
        pg_query($conn, 'DROP TABLE tblTasks;');
        echo 'Table tblTasks dropped.<br>';
    } catch (Exception $e) {
        echo 'Failed to drop table tblTasks: ' . $e->getMessage() . '<br>';
    }
}

/***    ================================================================================================================== */

function createTableTasks($conn)
{
    if (pg_query($conn, 'CREATE TABLE tblTasks(
        id serial PRIMARY KEY,
        proj_id INTEGER NOT NULL, /*fkey*/
        title VARCHAR(200) NOT NULL,
        descr TEXT NOT NULL,
        obs TEXT,
        hours_worked INTEGER NOT NULL,               /* hours worked each task*/
        bonus INTEGER DEFAULT 0,            /* little hearts received for small tasks */
        max_volunteers INTEGER DEFAULT 3,
        active BOOLEAN DEFAULT TRUE,
        done BOOLEAN DEFAULT FALSE,
        created_on TIMESTAMP NOT NULL,
        updated_on TIMESTAMP NOT NULL,
        due_date TIMESTAMP NOT NULL,
        CONSTRAINT task_proj_fkey FOREIGN KEY (proj_id)
        REFERENCES tblProjects(id)
        )  ')) {
        echo "Table Tasks created!<br>";
    } else {
        echo "Table tblTasks failed! :" . pg_last_error($conn) . "<br>";
    }
}

/***    ================================================================================================================== */

/**
 * insert random data
 */
function insertDataTasks($conn)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://taco-randomizer.herokuapp.com/random/?full-taco=true");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    for ($xi = 0; $xi < HOW_MANY_ASSOC; $xi++) {
        for ($task = 0; $task < HOW_MANY_TASKS; $task++) {
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $data = json_decode($response, true);

            insert_Task(
                $conn,
                $xi + 1, /* assoc_id */
                $data['name'], /*title*/
                array_key_exists('condiment', $data) ? $data['condiment']['recipe'] : null, /*obs*/
                $data['base_layer']['recipe'], /*desc*/
                rand(3, 10),
                (rand(0, 100)<35) ? 1: 0
            );
        }
    }
    
    curl_close($curl);
}

/**
 * Insert test data in tblTasks
 */
function insert_Task($conn, $assoc_id, $title, $obs, $desc, $hours, $bonus)
{
    if (rand(0, 100) < 40) {
        $done = 'TRUE';
        $timestamp = time() - rand(300, 450)*36000;
        //$start = strtotime("1 April 2020");
        //$end = strtotime("3 June 2020");
        //$timestamp = mt_rand($start, $end);
        $current_timestamp = time();

        $query  ='INSERT INTO tblTasks 
    (proj_id, title, descr, obs, hours_worked, bonus, created_on, updated_on, due_date) VALUES 
    (' . $assoc_id . ','
      . pg_escape_literal($title)
      . ',' . pg_escape_literal($desc)
      . ',' . pg_escape_literal($obs)
       . ',' . $hours
      . ',' . $bonus 
            . ',NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\', 
            NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\', 
            NOW() + (random() * (NOW()+\'366 days\' - NOW())) + \'30 days\')';

        echo $query . '<br>';

        try {
            if (pg_query($conn, $query)) {
                echo "Record added in tblTasks";
            }
        } catch (Exception $e) {
            // echo $e->getMessage();
        }
    }
}
