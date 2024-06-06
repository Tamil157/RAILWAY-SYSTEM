<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Details</title>
    <style>
        body {
            height: 100vh;
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Adjusted max-width for better form layout */
            width: 100%;
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
        
        form input[type="text"],
        form input[type="password"],
        form input[type="date"] {
            width: calc(100% - 20px); /* Adjusted width for input fields */
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
        
        .actions {
            margin-top: 20px;
            text-align: center;
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

    if (!isset($_POST["emailid"])) { // Check if emailid is set in $_POST
        $cdquery = "SELECT * FROM user WHERE id='" . $_GET["id"] . "'";
        $cdresult = mysqli_query($conn, $cdquery);
        $cdrow = mysqli_fetch_array($cdresult);

        echo "<form action=\"edit_user.php?id=" . $_GET["id"] . "\" method=\"post\">";
        echo "<table>";
        echo "<thead><tr><th>ID</th><th>Email ID</th><th>Password</th><th>Mobile No</th><th>Date of Birth</th></tr></thead>";
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $cdrow["id"] . "</td>";
        echo "<td><input type=\"text\" name=\"emailid\" value=\"" . $cdrow["emailid"] . "\" required></td>";
        echo "<td><input type=\"password\" name=\"password\" value=\"" . $cdrow["password"] . "\" required></td>";
        echo "<td><input type=\"text\" name=\"mobileno\" value=\"" . $cdrow["mobileno"] . "\" required></td>";
        echo "<td><input type=\"date\" name=\"dob\" value=\"" . $cdrow["dob"] . "\" required></td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "<input value='Update Record' type=\"submit\">";
        echo "</form>";
    } else {
        // Initialize variables to avoid warnings
        $emailid = $_POST["emailid"];
        $password = $_POST["password"];
        $mobileno = $_POST["mobileno"];
        $dob = $_POST["dob"];

        $sql = "UPDATE `user` SET `emailid`='$emailid', `password`='$password', `mobileno`='$mobileno', `dob`='$dob' WHERE id='" . $_GET["id"] . "'";

        if ($conn->query($sql) === TRUE) {
            echo "User details updated successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    echo "<div class='actions'>";
    echo "<a href=\"show_users.php\">Go Back to User Menu</a>";
    echo "<a href=\"admin_login_1.php\">Go Back to Admin Menu</a>";
    echo "</div>";

    $conn->close();
    ?>
</div>

</body>
</html>
