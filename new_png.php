<html>
<body style=" background-image: url(pnglogin.jpg);
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;" >

<?php 

session_start();

require "db.php";

$pname=$_POST["pname"];
$page=$_POST["page"];
$pgender=$_POST["pgender"];

$tno=$_SESSION["tno"];
$doj=$_SESSION["doj"];
$sp=$_SESSION["sp"];
$dp=$_SESSION["dp"];
$class=$_SESSION["class"];

$query="SELECT fare FROM classseats WHERE trainno='".$tno."' AND class='".$class."' AND doj='".$doj."' AND sp='".$sp."' AND dp='".$dp."'";
$result=mysqli_query($conn,$query) or die(mysql_error());

$row=mysqli_fetch_array($result);
$fare=$row[0];

$tempfare=0;
$temp=0;

for($i=0;$i<$_SESSION["nos"];$i++) 
{
 if($page[$i]>=18)
 {
  $temp++;
  $tempfare+=$fare;
 }
 else if($page[$i]<18)
  $tempfare+=0.5*$fare;
 else if($page[$i]>=60)
  $tempfare+=0.5*$fare;
}

if($temp==0)
{
 echo "<br><br>At least one adult must accompany!!!";
 echo "<br><br><a href=\"enquiry.php\">Back to Enquiry</a> <br>";
 die();
}

echo "Total fare is Rs.".$tempfare."/-";

// Adding the status attribute to the SQL query with the default value of "BOOKED"
$sql = "INSERT INTO resv(pnr, id, trainno, sp, dp, doj, tfare, class, nos) VALUES ('56', ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssi", $_SESSION["id"], $_SESSION["tno"], $_SESSION["sp"], $_SESSION["dp"], $_SESSION["doj"], $tempfare, $_SESSION["class"], $_SESSION["nos"]);

if ($stmt->execute()) 
{
 echo "<br><br>Reservation Successful";
} 
else 
{
 echo "<br><br>Error: " . $stmt->error;
}

$tid=$_SESSION["id"];
$ttno=$_SESSION["tno"];
$tdoj=$_SESSION["doj"];

$query="SELECT pnr FROM resv WHERE id=? AND trainno=? AND doj=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $tid, $ttno, $tdoj);
$stmt->execute();
$result = $stmt->get_result();

$row=mysqli_fetch_array($result);
$rpnr=$row['pnr'];

for($i=0;$i<$_SESSION["nos"];$i++) 
{
$sql = "INSERT INTO pd(pnr, pname, page, pgender) VALUES  (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $rpnr, $pname[$i], $page[$i], $pgender[$i]);

if ($stmt->execute()) 
{
 echo "<br><br>Passenger details added!!!";
} 
else 
{
 echo "<br><br>Error: " . $stmt->error;
}
}

echo "<br><br><a href=\"index.htm\">Go Back!!!</a> <br>";

$stmt->close();
$conn->close(); 
?>

</body>
</html>
