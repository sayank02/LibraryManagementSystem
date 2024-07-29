<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegesysdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = $_POST['studentid'];
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $session = $_POST['session'];
    $mobile = $_POST['mobile'];

    
    $sql = "INSERT INTO studentlist (studentid, name, roll, session, mobile) VALUES ('$studentid', '$name', '$roll', '$session', '$mobile')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: Main.html#AddStudent");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
