update book frontend details backend all in one
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['isbn'])) {
  $isbn = $connect->real_escape_string($_POST['isbn']);
  $title = $connect->real_escape_string($_POST['title']);
  $author = $connect->real_escape_string($_POST['author']);
  $publisher = $connect->real_escape_string($_POST['publisher']);
  $year = $connect->real_escape_string($_POST['year']);
  $language = $connect->real_escape_string($_POST['language']);
  $edition = $connect->real_escape_string($_POST['edition']);
  $subject = $connect->real_escape_string($_POST['subject']);
  $call_number = $connect->real_escape_string($_POST['call_number']);

  $sql = "UPDATE booklist SET 
          title = '$title', 
          author = '$author', 
          publisher = '$publisher', 
          year = '$year', 
          language = '$language', 
          edition = '$edition', 
          subject = '$subject', 
          call_number = '$call_number' 
          WHERE isbn = '$isbn'";

  if ($connect->query($sql) === TRUE) {
    header("Location: Main.html#availableBook");
    exit();
  } else {
    echo "Error updating record: " . $connect->error;
  }

  $connect->close();
  
  // Redirect back to the available books page
  header("Location: Main.html#availablebook1");
  exit;
} else {
  echo "Invalid request.";
}
?>
