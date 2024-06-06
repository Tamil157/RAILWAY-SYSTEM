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
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
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

    require "db.php";

    $sql = "INSERT INTO station(sname) VALUES ('".$_POST["sname"]."')";

    if ($conn->query($sql) === TRUE) {
        echo " '".$_POST["sname"]."': New record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    echo "<br> <a href=\"admin_login.php\">Go Back to Admin Menu!!!</a> ";

    $conn->close();
    ?>
</div>

</body>
</html>
