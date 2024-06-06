<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        select, input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    session_start();
    $_SESSION = array();
    session_destroy();
    ?>
    <form action="enquiry_result.php" method="post">
        <label for="sp">Starting Point:</label>
        <select id="sp" name="sp" required>
            <option value=""></option>
            <?php
            require "db.php";
            $cdquery = "SELECT sname FROM station";
            $cdresult = mysqli_query($conn, $cdquery);
            while ($cdrow = mysqli_fetch_array($cdresult)) {
                $cdTitle = $cdrow['sname'];
                echo "<option value=\"$cdTitle\">$cdTitle</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="dp">Destination Point:</label>
        <select id="dp" name="dp" required>
            <option value=""></option>
            <?php
            require "db.php";
            $cdquery = "SELECT sname FROM station";
            $cdresult = mysqli_query($conn, $cdquery);
            while ($cdrow = mysqli_fetch_array($cdresult)) {
                $cdTitle = $cdrow['sname'];
                echo "<option value=\"$cdTitle\">$cdTitle</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="doj">Date of Journey:</label>
        <input type="date" id="doj" name="doj" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>
    <br><br>
    <a href="index.html">Go to Home Page!!!</a>
</div>

</body>
</html>
