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
            margin-top: 12px;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #00C9FF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        input[type="text"] {
            width: 70%;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
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
    require "db.php";

    $cdquery = "SELECT id, sname FROM station";
    $cdresult = mysqli_query($conn, $cdquery);
    echo "
    <table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Station</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    ";

    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $cdId = $cdrow['id'];
        $cdTitle = $cdrow['sname'];
        echo "
        <tr>
            <td>$cdId</td>
            <td>$cdTitle</td>
            <td><a href=\"edit_station.php?id=".$cdId."\"><button>Edit</button></a></td>
            <td><a href=\"delete_station.php?id=".$cdId."\"><button>Delete</button></a></td>
        </tr>
        ";
    }
    echo "
    </tbody>
    </table>
    ";
    ?>

    <form action="insert_into_station.php" method="post">
        <span>Add Station: <input type="text" name="sname" placeholder="New Station" required>
        <input type="submit" value="Add"></span>
    </form>

    <br>
    <a href="admin_login.php">Go Back to Admin Menu!!!</a>
</div>

</body>
</html>
