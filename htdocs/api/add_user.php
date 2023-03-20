<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['status'])) {

        // Get the request data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $status = $_POST['status'];

        // Get the DB info
        require_once '../db_info.php';

        // Connect to the DB
        require_once '../db_connect.php';

        // Assign a query
        $query = " INSERT INTO user VALUES ('$username', '$hashed_password','$status') ";
        
        // Execute the query
        $response = $db->query( $query );
        if (!$response){
            die ("Could not query the database: <br />". $db->error);
        }
        
        $result = array();
        
        if (mysqli_affected_rows($db) == 1) {
            $result['success'] = true;
            $result['message'] = "User account created successfully";
        } else {
            $result['success'] = false;
            $result['message'] = "Failed to create user account";
        }
        
        // Return the JSON response
        header('Content-Type: application/json');
        echo json_encode($result);

    }
}

?>