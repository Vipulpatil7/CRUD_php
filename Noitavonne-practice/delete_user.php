<?php
// Database configuration
$servername = "localhost";
$username = "root"; // replace with your MySQL username
$password = "123456"; // replace with your MySQL password
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Start transaction
    $conn->begin_transaction();

    // Delete record
    $sql = "DELETE FROM contacts WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // Re-sequence the IDs
        $result = $conn->query("SELECT id FROM contacts ORDER BY id");
        $new_id = 1;
        while ($row = $result->fetch_assoc()) {
            $conn->query("UPDATE contacts SET id=$new_id WHERE id=" . $row['id']);
            $new_id++;
        }

        // Reset auto-increment
        $conn->query("ALTER TABLE contacts AUTO_INCREMENT = $new_id");

        // Commit transaction
        $conn->commit();

        echo "Record deleted and IDs resequenced successfully. <a href='users.php'>Go back to User Records</a>";
    } else {
        $conn->rollback();
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID specified.";
}

$conn->close();
?>
