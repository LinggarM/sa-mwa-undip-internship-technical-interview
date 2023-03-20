<?php

if ($_SERVER['REQUEST_METHOD']=='GET') {

    // Get the DB info
    require_once '../db_info.php';

    // Connect to the DB
    require_once '../db_connect.php';

    //Asign a query
    $query = " SELECT * FROM user";
    
    // Execute the query
    $result = $db->query( $query );
    if (!$result){
        die ("Could not query the database: <br />". $db->error);
    }
    
    // Fetch rows from the result set and put them in an array
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Return the JSON response
    header('Content-Type: application/json');
    echo json_encode($rows);
}

?>