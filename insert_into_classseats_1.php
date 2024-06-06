<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Schedule Form</title>
    <style>
        body {
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
        }

        form input[type="text"],
        form input[type="date"],
        form select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        form input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form action="insert_into_classseats_2.php" method="post">
    <label for="tno">Trains:</label><br>
    <select id="tno" name="tno" required>
        <?php
        require "db.php";
        $query = "SELECT * FROM train";
        $result = mysqli_query($conn, $query);
        echo "<option value=\"\"></option>";
        while ($row = mysqli_fetch_array($result)) {
            $tno = $row['trainno'];
            $tn = $row['tname'] . " starting at " . $row['sp'];
            echo "<option value=\"$tno\">$tn</option>";
        }
        ?>
    </select><br><br>

    <label for="doj">Date Of Journey:</label><br>
    <input type="date" id="doj" name="doj" required><br><br>

    <label for="class">Class Name:</label><br>
    <input type="text" id="class" name="class" required><br><br>

    <label for="fps">Fare per Seat:</label><br>
    <input type="text" id="fps" name="fps" required><br><br>

    <label for="seatsleft">Total Seats:</label><br>
    <input type="text" id="seatsleft" name="seatsleft" required><br><br>

    <input type="submit" value="Add Train Schedule">
</form>

</body>
</html>
