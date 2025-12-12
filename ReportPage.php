<?php
include 'Database_Connection.php';

$user_ID = '112233';

// Fetch reports from the database
$sql = "SELECT * FROM report WHERE user_ID='$user_ID' ORDER BY end_date DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>SmartBudget Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8f7;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1a8f55;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.8em;
            font-weight: bold;
            position: relative;
        }

        .action-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .action-buttons button {
            margin-left: 10px;
            background-color: #2bb673;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: 0.3s;
        }

        .action-buttons button:hover {
            background-color: #1a8f55;
        }

         /* Back button on top-left */
        .back-button {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: 0.3s;
            white-space: nowrap;
        }
        .back-button:hover {
            background-color: #c0392b;
        }

        .reports-container {
            width: 90%;
            margin: 40px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #1a8f55;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e8f5e9;
        }
    </style>
</head>
<body>
<header>
    Your Reports
     <button class="back-button" onclick="window.location.href='MainPage.html'">Back</button>
    <div class="action-buttons">
        <button onclick="window.location.href='AddingReport.html'">Add Report</button>
    </div>
</header>

<div class="reports-container">
    <table>
    <tr>
        <th>Report ID</th>
        <th>Type</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Total Income</th>
        <th>Total Expenses</th>
        <th>Total Balance</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['report_ID']}</td>
            <td>{$row['report_type']}</td>
            <td>{$row['start_date']}</td>
            <td>{$row['end_date']}</td>
            <td>\${$row['total_income']}</td>
            <td>\${$row['total_expenses']}</td>
            <td>\${$row['total_balance']}</td>
            <td><a href='EditingReport.php?report_id={$row['report_ID']}'>Edit</a></td>
            <td><a href='DeleteReport.php?report_id={$row['report_ID']}' onclick=\"return confirm('Are you sure you want to delete this report?');\">Delete</a></td>
            </tr>";
    }
}
?>
</table>
</div>
</body>
</html>
