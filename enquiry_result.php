<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Train Search Results</title>
<style>
    body {
        background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        width: 90%;
        overflow-x: auto; /* Enable horizontal scrolling if needed */
    }

    .container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .container table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: white; /* White background for the table */
    }

    .container table th,
    .container table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 16px;
    }

    .container table th {
        background-color: #f2f2f2; /* Light gray background for table headers */
    }

    .container form {
        margin-top: 20px;
        text-align: center;
    }

    .container form input[type="text"],
    .container form input[type="password"],
    .container form input[type="submit"] {
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
        width: 100%;
        max-width: 400px;
    }

    .container form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .container form input[type="submit"]:hover {
        background-color: #45a049;
    }

    .container a {
        text-decoration: none;
        color: #333;
        display: block;
        margin-top: 20px;
        text-align: center;
    }
</style>
</head>
<body>

<div class="container">
    <?php
    session_start();
    require "db.php";

    $doj = $_POST["doj"];
    $_SESSION["doj"] = "$doj";
    $sp = $_POST["sp"];
    $_SESSION["sp"] = "$sp";
    $dp = $_POST["dp"];
    $_SESSION["dp"] = "$dp";

    $query = mysqli_query($conn, "SELECT t.trainno,t.tname,c.sp,s1.departure_time,c.dp,s2.arrival_time,t.dd,c.class,c.fare,c.seatsleft FROM train as t,classseats as c, schedule as s1,schedule as s2 where s1.trainno=t.trainno AND s2.trainno=t.trainno AND s1.sname='" . $sp . "' AND s2.sname='" . $dp . "' AND t.trainno=c.trainno AND c.sp='" . $sp . "' AND c.dp='" . $dp . "' AND c.doj='" . $doj . "' ");

    echo "<h2>Train Search Results</h2>";
    echo "<table><thead><tr><th>Train No</th><th>Train Name</th><th>Starting Point</th><th>Departure Time</th><th>Destination Point</th><th>Arrival Time</th><th>Day</th><th>Train Class</th><th>Fare</th><th>Seats Left</th></tr></thead><tbody>";

    while ($row = mysqli_fetch_array($query)) {
        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</td><td>" . $row[8] . "</td><td>" . $row[9] . "</td></tr>";
    }
    echo "</tbody></table>";

    if (mysqli_num_rows($query) == 0) {
        echo "<p>No such train found.</p>";
    }
    ?>

    <p>If you wish to proceed with booking, fill in the following details:</p>
    <form action="resvn.php" method="post">
        Registered Mobile No: <input type="text" name="mno" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Enter Train No: <input type="text" name="tno" required><br><br>
        Enter Class: <input type="text" name="class" required><br><br>
        No. of Seats: <input type="text" name="nos" required><br><br>
        <input type="submit" value="Proceed with Booking"><br><br>
    </form>

    <a href="enquiry.php">More Enquiry</a><br>
    <a href="index.html">Go to Home Page!!!</a>
</div>

</body>
</html>
