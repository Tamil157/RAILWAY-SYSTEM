<html>
<body style=" background-image: url(adminlogin.jpeg);
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">

<?php
session_start();

require "db.php";

$stations = $_SESSION["stations"];
$flag = false;

$stmt = $conn->prepare("INSERT INTO classseats (trainno, sp, dp, doj, class, seatsleft, fare) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $trainno, $sp, $dp, $doj, $class, $seatsleft, $fare);

$temp = 0;
while ($temp < $_SESSION["ns"]) {
    $trainno = $_SESSION["trainno"];
    $sp = $_SESSION["st".$temp];
    $dp = $_SESSION["st".($temp+1)];
    $doj = $_SESSION["doj"];

    if ($_POST["s1".$temp] > 0) {
        $class = 'AC1';
        $seatsleft = $_POST["s1".$temp];
        $fare = $_POST["f1".$temp];
        $flag = $stmt->execute();
    }
    // Add conditions for other classes similarly...

    $temp += 1;
}

$stmt->close();

if ($flag) {
    echo "New seat arrangement added successfully";
} else {
    echo "Error: " . $conn->error;
}

echo "<br> <a href=\"admin_login.php\">Go Back to Admin Menu!!!</a> ";

?>
</body>
</html>
