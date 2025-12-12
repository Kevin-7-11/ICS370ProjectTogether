<?php
// -----------------------
// DATABASE CONNECTION
// -----------------------
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "ics370_project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// -------------------------------------------------
// IF FORM WAS SUBMITTED → UPDATE THE REPORT
// -------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $report_id      = $_POST['report_id'];
    $report_type    = $_POST['report_type'];
    $start_date     = $_POST['start_date'];
    $end_date       = $_POST['end_date'];
    $total_income   = $_POST['total_income'];
    $total_expenses = $_POST['total_expenses'];

   $total_balance = $total_income - $total_expenses;

    $sql = "UPDATE report 
        SET report_type='$report_type',
            start_date='$start_date',
            end_date='$end_date',
            total_income=$total_income,
            total_expenses=$total_expenses,
            total_balance=$total_balance
        WHERE report_ID='$report_id'";


    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Report updated successfully!');
                window.location.href = 'ReportPage.php';
              </script>";
        exit;
    } else {
        echo "Error updating report: " . $conn->error;
    }
}

// -------------------------------------------------
// IF PAGE WAS LOADED (GET request) → DISPLAY REPORT
// -------------------------------------------------
if (!isset($_GET['report_id'])) {
    die("No report ID provided.");
}

$report_id = $_GET['report_id'];

$sql = "SELECT * FROM report WHERE report_ID='$report_id'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Report not found.");
}

$report = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Report - SmartBudget</title>
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
        .back-button {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: 0.3s;
        }
        .back-button:hover {
            background-color: #c0392b;
        }
        .form-card {
            background: white;
            width: 90%;
            max-width: 520px;
            margin: 40px auto;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        label {
            font-weight: bold;
            display: block;
            margin: 12px 0 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 6px;
            font-size: 1em;
        }
        .save-button {
            margin-top: 20px;
            width: 100%;
            background-color: #1a8f55;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            transition: 0.3s;
        }
        .save-button:hover {
            background-color: #157347;
        }
    </style>
</head>
<body>

<header>
    Edit Report
    <button class="back-button" onclick="window.location.href='ReportPage.php'">Back</button>
</header>

<div class="form-card">

    <form action="EditingReport.php" method="POST">

        <input type="hidden" name="report_id" value="<?php echo $report['report_ID']; ?>">

        <label>Report Type:</label>
        <input type="text" name="report_type" value="<?php echo $report['report_type']; ?>" required>

        <label>Start Date:</label>
        <input type="date" name="start_date" value="<?php echo $report['start_date']; ?>" required>

        <label>End Date:</label>
        <input type="date" name="end_date" value="<?php echo $report['end_date']; ?>" required>

        <label>Total Income:</label>
        <input type="number" step="0.01" name="total_income" value="<?php echo $report['total_income']; ?>" required>

        <label>Total Expenses:</label>
        <input type="number" step="0.01" name="total_expenses" value="<?php echo $report['total_expenses']; ?>" required>

        <button class="save-button" type="submit">Save Changes</button>

    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>
