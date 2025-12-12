<?php
// AddReport.php
include 'Database_Connection.php'; // your file that connects to the DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from form
    $report_type = $_POST['report_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $total_income = $_POST['total_income'];
    $total_expenses = $_POST['total_expenses'];

    // Calculate total_balance
    $total_balance = $total_income - $total_expenses;

    // Generate a simple report ID
    $report_ID = rand(100000, 999999);

    // **Assume the user is logged in and you have their user_ID**
    // For now, let's hardcode a user_ID (you can later replace with session variable)
    $user_ID = '112233';

    // Insert into report table
    $sql = "INSERT INTO report (report_ID, user_ID, report_type, start_date, end_date, total_income, total_expenses, total_balance)
            VALUES ('$report_ID', '$user_ID', '$report_type', '$start_date', '$end_date', '$total_income', '$total_expenses', '$total_balance')";

    if ($conn->query($sql) === TRUE) {
    header("Location: ReportPage.php");
    exit();
}


    $conn->close();
} else {
    // If accessed directly, redirect to add page
    header("Location: ReportPage.php");
    exit();
}
?>
