<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        // database connection variables
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "portfolio";

        // create a database connection 
        $conn = new mysqli($host, $username, $password, $dbname);

        // check if connection was successful
        if($conn->connect_error){
            die("connection failed!" . $conn->connect_error);
        }

        // get the form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Prepare and bind SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        // execute the statement
        if ($stmt->execute()) {
            echo "Message submitted successfully";
        }else{
            echo "Error: " . $stmt->error;
        }

        // close statement and connection
        $stmt->close();
        $conn->close();
    }
?>