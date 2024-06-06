<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<style>
    body {
        background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        color: #333; /* Default text color */
    }
    
    .container {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        width: 90%;
        text-align: center;
    }
    
    .container h2 {
        margin-bottom: 20px;
        color: #333; /* Heading text color */
    }
    
    .container table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    
    .container table th, .container table td {
        padding: 10px;
        border: 1px solid #ccc;
        color: #333; /* Table text color */
    }
    
    .container table th {
        background-color: #f2f2f2;
    }
    
    .container table td {
        text-align: center;
    }
    
    .container form {
        margin-top: 20px;
    }
    
    .container form input[type="text"],
    .container form input[type="submit"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    
    .container form input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    
    .container form input[type="submit"]:hover {
        background-color: #45a049;
    }
    
    .container a {
        text-decoration: none;
        color: #333;
        display: block;
        margin-top: 20px;
    }
</style>
</head>
<body>

<div class="container">
    <?php
    session_start();
    require "db.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $mobile = isset($_POST["mno"]) ? $_POST["mno"] : null;
    $pwd = isset($_POST["password"]) ? $_POST["password"] : null;

    $query = mysqli_prepare($conn, "SELECT * FROM user WHERE user.mobileno=? AND user.password=?");
    mysqli_stmt_bind_param($query, "is", $mobile, $pwd);
    mysqli_stmt_execute($query);

    $result = mysqli_stmt_get_result($query); // Get the result set from the prepared statement

    $temp1 = null;
    $temp2 = null;
    if($row = mysqli_fetch_array($result)) {
        echo "<h2>Welcome ";
        $temp1 = $row['emailid'];
        $temp2 = $row['id'];
        echo "$temp1</h2>";
        echo "<br>";

        $query2 = mysqli_query($conn, "SELECT * FROM user,resv WHERE user.id=resv.id AND user.mobileno=$mobile") or die(mysqli_error($conn));

        echo "<table><thead><tr><th>PNR</th><th>Train No</th><th>Date Of Journey</th><th>Total Fare</th><th>Train Class</th><th>Seats Reserved</th><th>Status</th></tr></thead><tbody>";
        
        while($row = mysqli_fetch_array($query2)) {
            echo "<tr><td>".$row["pnr"]."</td><td>".$row["trainno"]."</td><td>".$row["doj"]."</td><td>".$row["tfare"]."</td><td>".$row["class"]."</td><td>".$row["nos"]."</td><td>".$row["status"]."</td></tr>";
        }

        echo "</tbody></table>";

        if(mysqli_num_rows($query2) == 0) {
            echo "<p>No Reservations Yet !!!</p>";
        }
    }

    $_SESSION["id"] = $temp2;

    if(mysqli_num_rows($result) == 0) {
        echo "<p>Wrong Combination!!!</p>";
        echo "<a href=\"index.html\">Home Page</a>";
        die();
    }
    ?>

    <form action="cancel.php" method="post">
        <label for="cancpnr">Enter PNR for Cancellation:</label><br>
        <input type="text" id="cancpnr" name="cancpnr" required><br><br>
        <input type="submit" value="Cancel"><br><br>
    </form>

    <a href="index.html">Home Page</a>
</div>

</body>
</html>
