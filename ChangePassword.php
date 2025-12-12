<?php
include 'Database_Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Confirm passwords match
    if ($new_password !== $confirm_password) {
        echo "<script>
                alert('New passwords do not match.');
                window.history.back();
              </script>";
        exit();
    }

    // 2. Check if the email exists
    $query = "SELECT user_password FROM sb_user WHERE user_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If email does not exist
    if ($stmt->num_rows === 0) {
        echo "<script>
                alert('Email not found.');
                window.history.back();
              </script>";
        exit();
    }

    $stmt->bind_result($db_password);
    $stmt->fetch();

    // 3. Verify current password
    if ($db_password !== $current_password) {
        echo "<script>
                alert('Current password is incorrect.');
                window.history.back();
              </script>";
        exit();
    }

    $stmt->close();

    // 4. Update password
    $update = $conn->prepare("UPDATE sb_user SET user_password = ? WHERE user_email = ?");
    $update->bind_param("ss", $new_password, $email);

    if ($update->execute()) {
        echo "<script>
                alert('Password changed successfully!');
                window.location.href = 'LoginPage.html';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Failed to update password.');
                window.history.back();
              </script>";
    }

    $update->close();
    $conn->close();
} else {
    header("Location: ChangePassword.html");
    exit();
}
?>


