<?php
require "db.php"; // Assuming db.php contains database connection details

// Retrieve form data
$pwd = $_POST["password"];
$eid = $_POST["emailid"];
$mno = $_POST["mobileno"];
$dob = $_POST["dob"];

// Calculate age based on date of birth
$today = new DateTime();
$birthdate = new DateTime($dob);
$age = $birthdate->diff($today)->y;

// Check if age is at least 18
if ($age < 18) {
    die("Minimum age requirement of 18 years not met.");
}

// Prepare SQL statement to insert user data
$sql = "INSERT INTO user (password, emailid, mobileno, dob) 
        VALUES ('".$pwd."', '".$eid."', '".$mno."', '".$dob."')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Hi $eid, <a href=\"index.html\">Click here</a> to browse through our website!!!";
} else {
    echo "Error: " . $conn->error . "<br><a href=\"new_user_form.html\">Go Back to Login!!!</a>";
}

$conn->close(); // Close database connection
?>
