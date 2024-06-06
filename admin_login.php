<?php 
session_start();

// Check if the form is submitted
if(isset($_POST["uid"]) && isset($_POST["password"])) {
    // Check if user ID and password are correct
    if($_POST["uid"] == 'admin' && $_POST["password"] == 'admin') {
        // Set session variable to indicate successful login
        $_SESSION["admin_login"] = true;
    } else {
        // If login failed, display an alert and go back to the previous page
        echo "<script>alert('Incorrect password!'); window.history.back();</script>";
        exit; // Prevent further execution of the script
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }
        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #007BFF;
        }
        .container a {
            display: block;
            margin: 10px 0;
            padding: 13px 20px;
            text-decoration: none;
            color: #007BFF;
            border: 1px solid #007BFF;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .container a:hover {
            background-color: #007BFF;
            color: white;
        }
        .container form {
            display: inline-block;
            margin-top: 20px;
        }
        .container form input[type="text"],
        .container form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container form input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .container form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Railway Management System Admin Access</h1>
        <?php 
        // Check if admin is logged in
        if(isset($_SESSION["admin_login"]) && $_SESSION["admin_login"] == true) {
            echo "<a href=\"insert_into_stations.php\">Show All Stations</a>";
            echo "<a href=\"show_trains.php\">Show All Trains</a>";
            echo "<a href=\"show_users.php\">Show All Users</a>";
            echo "<a href=\"insert_into_train_3.php\">Enter New Train</a>";
            echo "<a href=\"insert_into_classseats_3.php\">Enter Train Schedule</a>";
            echo "<a href=\"booked.php\">View all booked tickets</a>";
            echo "<a href=\"cancelled.php\">View all cancelled tickets</a>";
            echo "<a href=\"logout.php\">Logout</a>";
        } else {
            // If not logged in, display the login form
            echo "
            <form action=\"admin_login.php\" method=\"post\">
                <input type=\"text\" name=\"uid\" placeholder=\"User ID\" required><br>
                <input type=\"password\" name=\"password\" placeholder=\"Password\" required><br>
                <input type=\"submit\" value=\"Login\">
            </form>
            ";
        }
        ?>
        <br>
        <a href="index.html" style="text-decoration: none; color: #007BFF;">Go to Home Page!!!</a>
    </div>
</body>
</html>
