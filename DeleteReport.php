<?php
include 'Database_Connection.php';

if (!isset($_GET['report_id'])) {
    die("No report ID provided.");
}

$report_id = $_GET['report_id'];

// Delete the report
$sql = "DELETE FROM report WHERE report_ID='$report_id'";
if ($conn->query($sql) === TRUE) {
    // Redirect back to reports page
    header("Location: ReportPage.php");
    exit();
} else {
    echo "Error deleting report: " . $conn->error;
}

$conn->close();
?>