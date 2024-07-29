delete book backend<?php
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['isbn'])) {
 // Sanitize input
 $isbn = $connect->real_escape_string($_POST['isbn']);

 // Delete the book from issuedbook table
 $deleteSql = "DELETE FROM booklist WHERE isbn = '$isbn'";
 
 if ($connect->query($deleteSql) === TRUE) {
  echo " ";
  
 } else {
   echo "Error deleting record: " . $connect->error;
 }

 $connect->close();
 
 // Redirect back to the previous page
 header("Location: Main.html#availableBook");
 
 exit;
} else {
 echo "Invalid request.";
}
?>
