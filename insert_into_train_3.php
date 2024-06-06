<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        select, input[type="text"], input[type="time"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
session_start();
require "db.php";

if (isset($_POST["ns"])) {
    $ns = $_POST["ns"];
    $tname = $_POST["tname"];
    $_SESSION["tname"] = $tname;
    $sp = $_POST["sp"];
    $_SESSION["sp"] = $sp;
    $st = $_POST["st"];
    $_SESSION["st"] = $st;
    $dp = $_POST["dp"];
    $_SESSION["dp"] = $dp;
    $dt = $_POST["dt"];
    $_SESSION["dt"] = $dt;
    $dd = $_POST["dd"];
    $_SESSION["dd"] = $dd;
    $ds = $_POST["ds"];
    $_SESSION["ds"] = $ds;

    echo "<table><thead><tr><th>Train_name</th><th>Starting_point</th><th>Starting_time</th><th>Destination_point</th><th>Destination_time</th><th>Day_of_arrival</th><th>No_of_stations</th><th>Distance</th></tr></thead>";
    echo "<tr><td>".$tname."</td><td>".$sp."</td><td>".$st."</td><td>".$dp."</td><td>".$dt."</td><td>".$dd."</td><td>".$ns."</td><td>".$ds."</td></tr></table>";

    echo "<table><thead><tr><th>Station</th><th>Arrival_Time</th><th>Departure_Time</th><th>Distance</th></tr></thead>";
    echo "<tr><td>".$sp."</td><td>".$st."</td><td>".$st."</td><td>0</td></tr>";

    echo "<form action=\"insert_into_train_4.php\" method=\"post\">";
    $temp = 1;
    while ($temp <= $ns) {
        echo "<tr><td><select id=\"stn".$temp."\" name=\"stn".$temp."\" required>";
        $cdquery = "SELECT sname FROM station";
        $cdresult = mysqli_query($conn, $cdquery);

        echo "<option value=\"\"></option>";
        while ($cdrow = mysqli_fetch_array($cdresult)) {
            $cdTitle = $cdrow['sname'];
            echo "<option value=\"$cdTitle\">$cdTitle</option>";
        }

        echo "</select></td>
        <td><input type=\"text\" name=\"st".$temp."\" required></td>
        <td><input type=\"text\" name=\"dt".$temp."\" required></td>
        <td><input type=\"text\" name=\"ds".$temp."\" required></td></tr>";
        $temp += 1;
    }

    echo "<tr><td>".$dp."</td><td>".$dt."</td><td>".$dt."</td><td>".$ds."</td></tr></table>";	
    echo "<input type=\"submit\">";
    echo "</form>";

} else {
    echo "<form action=\"insert_into_train_3.php\" method=\"post\">
    <table>
    <tr><td>Train Name </td><td> <input type=\"text\" name=\"tname\" required></td></tr>
    <tr><td>Starting Point </td><td> <select id=\"sp\" name=\"sp\" required>";

    $cdquery = "SELECT sname FROM station";
    $cdresult = mysqli_query($conn, $cdquery);

    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $cdTitle = $cdrow['sname'];
        echo "<option value=\"$cdTitle\">$cdTitle</option>";
    }

    echo "</select></td></tr>
    <tr><td>Starting Time </td><td> <input type=\"time\" name=\"st\" required></td></tr>
    <tr><td>Destination Point </td><td> <select id=\"dp\" name=\"dp\" required>";

    $cdquery = "SELECT sname FROM station";
    $cdresult = mysqli_query($conn, $cdquery);

    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $cdTitle = $cdrow['sname'];
        echo "<option value=\"$cdTitle\">$cdTitle</option>";
    }

    echo "</select></td></tr>
    <tr><td>Destination Time </td><td> <input type=\"time\" name=\"dt\" required></td></tr>
    <tr><td>Distance </td><td> <input type=\"text\" name=\"ds\" required></td></tr>
    <tr><td>No Of Intermediate stations</td><td><input type=\"text\" name=\"ns\" required></td></tr>
    <tr><td>Day of Arrival </td><td> <input type=\"text\" name=\"dd\" required></td></tr>
    </table>
    <input type=\"submit\" value=\"Enter Train Details\">
    </form>";
}

echo "<br> <a href=\"admin_login.php\">Go Back to Admin Menu</a>";
?>
</body>
</html>
