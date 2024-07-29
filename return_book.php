
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "collegesysdb";

// Create connection
$connect = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

// Check if POST request and 'id' is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['roll'])) {
 // Sanitize input
 $roll = $connect->real_escape_string($_POST['roll']);

 // Delete the book from issuedbook table
 $deleteSql = "DELETE FROM issuedbook WHERE roll = '$roll'";
 
 if ($connect->query($deleteSql) === TRUE) {
  echo " ";
 } else {
   echo "Error deleting record: " . $connect->error;
 }

 $connect->close();
 
 // Redirect back to the previous page
 header("Location: Main.html#issuedBook");
 exit;
} else {
 echo "Invalid request.";
}
?>
