
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

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $connect->real_escape_string($_POST['name']);
    $roll = $connect->real_escape_string($_POST['roll']);
    $bookname = $connect->real_escape_string($_POST['bookname']);
    $author = $connect->real_escape_string($_POST['author']);
    $subject = $connect->real_escape_string($_POST['subject']);
    $issue_date = $connect->real_escape_string($_POST['issue_date']);
    $return_date = $connect->real_escape_string($_POST['return_date']);

    // Insert data into the database
    $sql = "INSERT INTO issuedbook (name, roll, bookname, author, subject, issue_date, return_date) 
            VALUES ('$name', '$roll', '$bookname', '$author', '$subject', '$issue_date', '$return_date')";

    if ($connect->query($sql) === TRUE) {
        header("Location: Main.html#issuebook");
        exit();
    } else {
        echo "Error issuing book: " . $connect->error;
    }

    $connect->close();
}
?>

