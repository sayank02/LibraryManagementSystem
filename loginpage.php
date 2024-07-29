loginpage backend

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
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Password entered by user

    // Construct SQL query to fetch hashed password for the given email
    $sql = "SELECT password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password']; // Retrieve hashed password from database

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct
            $_SESSION['user'] = $email; // Set session variable
            header("Location: Main.html"); // Redirect to a protected page
            exit();
        } else {
            // Incorrect password
            echo "Invalid email or password.";
        }
    } else {
        // Email not found
        echo "Invalid email or password.";
    }

    $conn->close();
}
?>
