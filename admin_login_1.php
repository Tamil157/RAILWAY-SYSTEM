<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            height: 100vh;
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px; /* Adjusted max-width for better form layout */
            text-align: center; /* Center align content */
        }
        
        .container a {
            display: block;
            width: 100%; /* Full width for responsiveness */
            padding: 15px 0; /* Vertical padding */
            margin: 10px 0; /* Vertical margin */
            background-color: #4CAF50; /* Green background color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for a lifted effect */
            font-size: 18px; /* Font size for better readability */
        }
        
        .container a:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        
        .container a:last-child {
            margin-bottom: 0; /* Remove bottom margin from the last link */
        }
    </style>
</head>
<body>

<div class="container">
    <?php 
    echo "<a href=\"insert_into_stations.php\">Show All Station</a>";
    echo "<a href=\"insert_into_train_1.php\">Enter New Train</a>";
    echo "<a href=\"insert_into_classseats_1.php\">Enter Train Schedule</a>";
    echo "<a href=\"booked.php\">View all booked tickets</a>";
    echo "<a href=\"cancelled.php\">View all cancelled tickets</a>";
    ?>
    <br><br><a href="index.html">Go to Home Page!!! You'll be Logged Out!!!</a>
</div>

</body>
</html>
