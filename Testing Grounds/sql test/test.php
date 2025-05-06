<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>datatest</title>
</head>

<body>

<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the form field name matches here
    $texts = trim($_POST['texts']);

    try {
        // Insert the word into 'text_test' table
        $stmt = $pdo->prepare('INSERT INTO text_test (texts) VALUES (?)');
        $stmt->execute([$texts]);

        echo "<p>Word added successfully!</p>";
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<form method="POST">
    <label>texts: <textarea name="texts" id="texts" required></textarea></label><br>
    <button type="submit">Add Word</button>
</form>

</body>
</html>