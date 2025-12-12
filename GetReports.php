<?php
include 'Database_Connection.php';  // Your DB connection

// Query all reports
$sql = "SELECT report_ID, report_type, start_date, end_date, total_income, total_expenses, total_balance 
        FROM report";

$result = $conn->query($sql);

// Prepare array to return
$reports = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }
}

$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($reports);
?>
