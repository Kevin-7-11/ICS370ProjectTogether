<?php
include 'Database_Connection.php'; //connects to database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];

    //query to find matching user
    $sql = "SELECT * FROM sb_user WHERE user_email = '$user_email' AND user_password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login successful!";
        header("Location: MainPage.html");
        exit();
    } else {
        echo "<script>alert('Invalid email or password.'); window.history.back();</script>"; //pop-up saying invalid email or password
    }

    $conn->close();
}
?>