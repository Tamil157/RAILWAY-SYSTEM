<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Train List</title>
<style>
    body {
        background-color: #f0f0f0; /* Light gray background */
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 20px;
    }
    
    .container {
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 1000px; /* Increased max-width for wider table */
        width: 100%;
        overflow-x: auto; /* Enable horizontal scrolling if needed */
    }
    
    table {
        width: 100%; /* Table takes full width of container */
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    table th, table td {
        padding: 12px; /* Increased padding for better spacing */
        text-align: left;
        border-bottom: 1px solid #ddd; /* Light gray border bottom */
        color: #333; /* Black text color */
    }
    
    table th {
        background-color: #f2f2f2; /* Light gray background for header */
    }
    
    table td a {
        text-decoration: none;
        color: #333;
    }
    
    table td button {
        padding: 10px 16px; /* Adjusted button padding */
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    table td button:hover {
        background-color: #45a049;
    }
    
    .actions {
        margin-top: 20px;
    }
    
    .actions a {
        text-decoration: none;
        color: #333;
        margin-right: 10px;
    }
</style>
</head>
<body>

<div class="container">
    <?php
    require "db.php";

    $cdquery = "SELECT * FROM train";
    $cdresult = mysqli_query($conn, $cdquery);

    echo "<table>";
    echo "<thead><tr><th>Train No</th><th>Train Name</th><th>Starting Point</th><th>Arrival Time</th><th>Destination Point</th><th>Departure Time</th><th>Day</th><th>Distance</th><th></th></tr></thead>";
    echo "<tbody>";

    while ($cdrow = mysqli_fetch_array($cdresult)) {
        echo "<tr>";
        echo "<td>".$cdrow['trainno']."</td>";
        echo "<td>".$cdrow['tname']."</td>";
        echo "<td>".$cdrow['sp']."</td>";
        echo "<td>".$cdrow['st']."</td>";
        echo "<td>".$cdrow['dp']."</td>";
        echo "<td>".$cdrow['dt']."</td>";
        echo "<td>".$cdrow['dd']."</td>";
        echo "<td>".$cdrow['distance']."</td>";
        echo "<td><a href=\"schedule.php?trainno=".$cdrow['trainno']."\"><button>Schedule</button></a></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<div class='actions'>";
    echo "<a href=\"insert_into_train_3.php\">Add New Train</a>";
    echo "<a href=\"admin_login.php\">Go Back to Admin Menu</a>";
    echo "</div>";
    ?>
</div>

</body>
</html>
