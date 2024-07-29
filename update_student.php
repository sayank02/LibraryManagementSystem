
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
    $name = $connect->real_escape_string($_POST['name']);
    $roll = $connect->real_escape_string($_POST['roll']);
    $session = $connect->real_escape_string($_POST['session']);
    $mobile = $connect->real_escape_string($_POST['mobile']);

    // Update the student record
    $sql = "UPDATE studentlist SET name = '$name', roll = '$roll', session = '$session', mobile = '$mobile' WHERE studentid = '$studentid'";

    if ($connect->query($sql) === TRUE) {
        // Redirect back to the student list page with a success message
        header("Location: Main.html#studentlist");
        exit();
    } else {
        // Output error message if update fails
        echo "Error updating record: " . $connect->error;
    }

    $connect->close();
} else {
    echo "Invalid request.";
}
?>
