<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        form input[type="time"],
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

<form action="insert_into_train_2.php" method="post">
    <label for="tname">Train Name:</label><br>
    <input type="text" id="tname" name="tname" required><br><br>

    <label for="sp">Starting Point:</label><br>
    <select id="sp" name="sp" required>
        <?php
        require "db.php";
        $cdquery = "SELECT sname FROM station";
        $cdresult = mysqli_query($conn, $cdquery);
        echo "<option value=\"\"></option>";
        while ($cdrow = mysqli_fetch_array($cdresult)) {
            $cdTitle = $cdrow['sname'];
            echo "<option value=\"$cdTitle\">$cdTitle</option>";
        }
        ?>
    </select><br><br>

    <label for="st">Starting Time:</label><br>
    <input type="time" id="st" name="st" required><br><br>

    <label for="dp">Destination Point:</label><br>
    <select id="dp" name="dp" required>
        <?php
        $cdquery = "SELECT sname FROM station";
        $cdresult = mysqli_query($conn, $cdquery);
        echo "<option value=\"\"></option>";
        while ($cdrow = mysqli_fetch_array($cdresult)) {
            $cdTitle = $cdrow['sname'];
            echo "<option value=\"$cdTitle\">$cdTitle</option>";
        }
        ?>
    </select><br><br>

    <label for="dt">Destination Time:</label><br>
    <input type="time" id="dt" name="dt" required><br><br>

    <label for="dd">Day of Arrival:</label><br>
    <input type="text" id="dd" name="dd" required><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
