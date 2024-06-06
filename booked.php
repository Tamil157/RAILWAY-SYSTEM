<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff; /* White background for the table */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            color: black; /* Text color set to black */
        }

        table th {
            background-color: #f2f2f2; /* Light gray background for table headers */
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternate row background color */
        }

        table tr:hover {
            background-color: #e9e9e9; /* Hover row background color */
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
require "db.php";

$query = "SELECT * FROM resv WHERE status='BOOKED'";
$result = mysqli_query($conn, $query);

echo "<table>
        <thead>
            <tr>
                <th>PNR</th>
                <th>Id</th>
                <th>Train No</th>
                <th>Date Of Journey</th>
                <th>Fare</th>
                <th>Train Class</th>
                <th>Seats</th>
                <th>Status</th>
            </tr>
        </thead>";

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>".$row[0]."</td>
            <td>".$row[1]."</td>
            <td>".$row[2]."</td>
            <td>".$row[5]."</td>
            <td>".$row[6]."</td>
            <td>".$row[7]."</td>
            <td>".$row[8]."</td>
            <td>".$row[9]."</td>
          </tr>";
}

echo "</table>";

echo "<br><a href=\"admin_login.php\">Go Back to Admin Menu</a>";

$conn->close();
?>

</body>
</html>
