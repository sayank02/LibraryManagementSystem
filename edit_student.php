
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

// Check if 'studentid' is provided via GET request
if (isset($_GET['studentid'])) {
    $studentid = $connect->real_escape_string($_GET['studentid']);

    // Fetch student details
    $sql = "SELECT * FROM studentlist WHERE studentid = '$studentid'";
    $result = $connect->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Edit Student</title>
            <style>/* Reset some default styles */
body, h1, form {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Set up the body with a background color and center the content */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Style the container for the edit student form */
#edit-student {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

/* Style the heading */
#edit-student h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #444;
}

/* Style the form elements */
form {
    display: flex;
    flex-direction: column;
}

label {
    font-size: 16px;
    margin-bottom: 5px;
    color: #666;
}

input[type="text"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
    font-size: 16px;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

button:focus {
    outline: none;
}
</style>
        </head>
        <body>
            <div id="edit-student">
                <h1>Edit Student</h1>
                <form action="update_student.php" method="post">
                    <input type="hidden" name="studentid" value="<?php echo htmlspecialchars($row['studentid']); ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>

                    <label for="roll">Roll:</label>
                    <input type="text" id="roll" name="roll" value="<?php echo htmlspecialchars($row['roll']); ?>" required><br>

                    <label for="session">Session:</label>
                    <input type="text" id="session" name="session" value="<?php echo htmlspecialchars($row['session']); ?>" required><br>

                    <label for="mobile">Mobile:</label>
                    <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>" required><br>

                    <button type="submit">Update Student</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Student not found.";
    }
} else {
    echo "No student ID provided.";
}

$connect->close();
?>
