
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

// Check if POST request and 'studentid' is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['studentid'])) {
    // Sanitize input
    $studentid = $connect->real_escape_string($_POST['studentid']);

    // Delete the student from studentlist table
    $deleteSql = "DELETE FROM studentlist WHERE studentid = '$studentid'";
    
    if ($connect->query($deleteSql) === TRUE) {
        // Redirect back to the previous page with a success message
        header("Location: Main.html#studentlist");
        exit();
    } else {
        // Output error message if delete fails
        echo "Error deleting record: " . $connect->error;
    }

    $connect->close();
} else {
    echo "Invalid request.";
}
?>
