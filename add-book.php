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
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $language = $_POST['language'];
    $edition = $_POST['edition'];
    $subject = $_POST['subject'];
    $call_number = $_POST['call_number'];


    $sql = "INSERT INTO booklist (title, author, isbn, publisher, year, language, edition, subject,call_number) VALUES ( '$title', '$author', '$isbn', '$publisher', '$year', '$language', '$edition', '$subject', '$call_number')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Main.html#AddBook");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    $conn->close();
}
?>
