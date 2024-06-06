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

    $stationId = $_GET["id"];

    // Check if the station is referenced in the classseats table
    $checkQuery = "SELECT COUNT(*) as count FROM classseats WHERE sp = (SELECT sname FROM station WHERE id = ?)";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $stationId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "Cannot delete station because it is referenced in the classseats table.";
    } else {
        // Proceed with deletion
        $sql = "DELETE FROM station WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $stationId);

        if ($stmt->execute() === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    echo "<br> <a href=\"admin_login.php\">Go Back to Admin Menu!!!</a> ";

    $stmt->close();
    $conn->close();
    ?>

</div>

</body>
</html>
