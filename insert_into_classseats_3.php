<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert into Class Seats</title>
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
            color: black; /* Ensure table text is black */
        }
        th {
            background-color: #f2f2f2;
        }
        select, input[type="text"], input[type="date"], input[type="submit"] {
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

if (isset($_POST["tno"])) {
    $trainno = $_POST["tno"];
    $_SESSION["trainno"] = $trainno;
    $doj = $_POST["doj"];
    $_SESSION["doj"] = $doj;

    $cdquery = "SELECT * FROM train WHERE trainno='$trainno'";
    $cdresult = mysqli_query($conn, $cdquery);
    $cdrow = mysqli_fetch_array($cdresult);

    echo "<table>
            <thead>
                <tr>
                    <th>Train_no</th>
                    <th>Train_name</th>
                    <th>Starting_point</th>
                    <th>Starting_time</th>
                    <th>Destination_point</th>
                    <th>Destination_time</th>
                    <th>Day_of_arrival</th>
                    <th>Distance</th>
                    <th>Date_Of_Journey</th>
                </tr>
            </thead>
            <tr>
                <td>{$cdrow['trainno']}</td>
                <td>{$cdrow['tname']}</td>
                <td>{$cdrow['sp']}</td>
                <td>{$cdrow['st']}</td>
                <td>{$cdrow['dp']}</td>
                <td>{$cdrow['dt']}</td>
                <td>{$cdrow['dd']}</td>
                <td>{$cdrow['distance']}</td>
                <td>{$doj}</td>
            </tr>
          </table>";

    $cdquery = "SELECT sname FROM schedule WHERE trainno='$trainno' ORDER BY distance ASC";
    $cdresult = mysqli_query($conn, $cdquery);
    $stations = array();
    $i = 0;
    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $stations[$i] = $cdrow["sname"];
        $i += 1;
    }

    $_SESSION["ns"] = $i - 1;
    $_SESSION["stations"] = $stations;

    echo "<form action=\"insert_into_classseats_4.php\" method=\"post\">
          <table>
            <thead>
                <tr>
                    <th>Starting Point</th>
                    <th>Destination Point</th>
                    <th>AC1 seats</th>
                    <th>AC1 Fare</th>
                    <th>AC2 seats</th>
                    <th>AC2 Fare</th>
                    <th>AC3 seats</th>
                    <th>AC3 Fare</th>
                    <th>CC seats</th>
                    <th>CC Fare</th>
                    <th>EC seats</th>
                    <th>EC Fare</th>
                    <th>SL seats</th>
                    <th>SL Fare</th>
                </tr>
            </thead>";

    $temp = 0;
    while ($temp < $_SESSION["ns"]) {
        $_SESSION["st" . $temp] = $stations[$temp];
        $temp += 1;
    }

    $temp = 0;
    while ($temp < $_SESSION["ns"]) {
        echo "<tr>
                <td>{$stations[$temp]}</td>
                <td>{$stations[$temp + 1]}</td>
                <td><input type=\"text\" name=\"s1{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"f1{$temp}\" value=\"0\" required></td>	
                <td><input type=\"text\" name=\"s2{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"f2{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"s3{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"f3{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"s4{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"f4{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"s5{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"f5{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"s6{$temp}\" value=\"0\" required></td>
                <td><input type=\"text\" name=\"f6{$temp}\" value=\"0\" required></td>
              </tr>";
        $temp += 1;
    }

    echo "</table><input type=\"submit\" value=\"Submit\"></form>";

} else {
    echo "<form action=\"insert_into_classseats_3.php\" method=\"post\">
          <table>
            <thead>
                <tr>
                    <th>Train</th>
                    <th>Date Of Journey</th>
                </tr>
            </thead>
            <tr>
                <td>
                    <select id=\"tno\" name=\"tno\" required>
                        <option value=\"\">Select Train</option>";

    $query = "SELECT * FROM train";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {
        $tno = $row['trainno'];
        $tn = $row['tname'] . " starting at " . $row['sp'];
        echo "<option value=\"$tno\">$tn</option>";
    }

    echo "</select></td>
                <td><input type=\"date\" name=\"doj\" required></td>
            </tr>
          </table>
          <input type=\"submit\" value=\"Enter Train Details\">
          </form>";
}

echo "<br><a href=\"admin_login.php\">Go Back to Admin Menu</a>";
?>
</body>
</html>
