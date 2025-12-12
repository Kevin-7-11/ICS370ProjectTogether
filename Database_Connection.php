<?php
    $servername = "localhost"; //this runs on local host which is the server name
    $username = "root"; //username
    $password = ""; //empty password
    $dbname = "ics370_project";//this is the actual database name

    $conn = new mysqli($servername, $username, $password, $dbname); //making the connection to the database

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);//this code will run if the connection to the database isn't working
}

?>