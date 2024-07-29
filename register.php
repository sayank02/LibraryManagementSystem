register backend

<?php
session_start();

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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $conn->real_escape_string($_POST['Fname']);
    $lname = $conn->real_escape_string($_POST['Lname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Password entered by user

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Construct SQL query to insert data
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$fname', '$lname', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['successMessage'] = "Registration successful. You can now log in.";
        header("Location: LoginPage.html"); // Redirect to a page or login
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
