<?php

$conn = pg_connect("host=ec2-34-198-243-120.compute-1.amazonaws.com dbname=dfko4he5vmn58l user=hznkjkdkjjtxjy password=7d658e3031072923ee68a0e6c3e42d55d795fb0ac3934ed68e659d08be785c2a")
or die('Could not connect: ' . pg_last_error());

if (pg_connection_status($conn) == PGSQL_CONNECTION_OK){
    $GLOBALS['db'] = $conn;
}