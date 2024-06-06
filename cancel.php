<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cancellation Result</title>
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
        max-width: 600px;
        width: 90%;
        text-align: center;
    }
    
    .container p {
        margin-bottom: 20px;
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

    $pnr = isset($_POST["cancpnr"]) ? $_POST["cancpnr"] : null;
    $uid = $_SESSION["id"];

    $sql = "UPDATE resv SET status ='CANCELLED' WHERE pnr='".$pnr."' AND id='".$uid."'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Cancellation Successful!!!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }

    echo "<a href=\"index.html\">Home Page</a>";

    $conn->close(); 
    ?>
</div>

</body>
</html>
