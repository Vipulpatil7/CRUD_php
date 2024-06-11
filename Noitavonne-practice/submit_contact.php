<?php
// Database configuration
$servername = "localhost";
$username = "root"; // replace with your MySQL username
$password = "123456"; // replace with your MySQL password
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $city = $_POST['city'];
    $mobile_no = $_POST['mobno'];

    // Prepare and bind
    $query = "INSERT INTO contacts (first_name, last_name, city, mobile_no) VALUES ('$first_name', '$last_name', '$city', '$mobile_no')";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        header("Location: inserted.html");
        // echo "Record Inserted";
        exit();
    }
}

$conn->close();
?>
