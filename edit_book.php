edit  book fronted backend all in one
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

if (isset($_GET['isbn'])) {
  $isbn = $connect->real_escape_string($_GET['isbn']);

  // Fetch the book details
  $sql = "SELECT * FROM booklist WHERE isbn = '$isbn'";
  $result = $connect->query($sql);

  if ($result && $row = $result->fetch_assoc()) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>/* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        /* Container for the edit form */
        #edit-book {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* Heading styling */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333333;
        }
        
        /* Form element styling */
        form {
            display: flex;
            flex-direction: column;
        }
        
        /* Label styling */
        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555555;
        }
        
        /* Input field styling */
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }
        
        /* Button styling */
        button[type="submit"] {
            padding: 10px 15px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        /* Button hover effect */
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        </style>
      <title>Edit Book</title>
    </head>
    <body>
      <div id="edit-book">
        <h1>Edit Book</h1>
        <form action="update_book.php" method="post">
          <input type="hidden" name="isbn" value="<?php echo htmlspecialchars($row['isbn']); ?>">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br>

          <label for="author">Author:</label>
          <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" required><br>

          <label for="publisher">Publisher:</label>
          <input type="text" id="publisher" name="publisher" value="<?php echo htmlspecialchars($row['publisher']); ?>" required><br>

          <label for="year">Year:</label>
          <input type="text" id="year" name="year" value="<?php echo htmlspecialchars($row['year']); ?>" required><br>

          <label for="language">Language:</label>
          <input type="text" id="language" name="language" value="<?php echo htmlspecialchars($row['language']); ?>" required><br>

          <label for="edition">Edition:</label>
          <input type="text" id="edition" name="edition" value="<?php echo htmlspecialchars($row['edition']); ?>" required><br>

          <label for="subject">Subject:</label>
          <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" required><br>

          <label for="call_number">Call Number:</label>
          <input type="text" id="call_number" name="call_number" value="<?php echo htmlspecialchars($row['call_number']); ?>" required><br>

          <button type="submit">Update Book</button>
        </form>
      </div>
    </body>
    </html>
    <?php
  } else {
    echo "Book not found.";
  }
} else {
  echo "No ISBN provided.";
}

$connect->close();
?>
