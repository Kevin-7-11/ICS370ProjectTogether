<?php
include 'Database_Connection.php'; //this connects the database connection file for mySQL

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //getting the form data
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $user_email = $_POST['user_email'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    $user_ID = rand(100000, 999999); //this generates a simple user id

    $sql = "INSERT INTO sb_user (user_ID, first_name, last_name, user_email, user_password, user_status)
        VALUES ('$user_ID', '$first_name', '$last_name', '$user_email', '$password', 'active')";
    //this code stores the users information in the database table

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        //redirects to the login page if registration is successful
        header("Location: LoginPage.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>