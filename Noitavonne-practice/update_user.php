<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="form_1.html">Home</a></li>
            <li><a href="users.php">Users</a></li>
        </ul>
    </nav>
    <div class="heading">
        <h1>Update User</h1>
    </div>
    <div class="container">
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update record
            $id = $_POST['id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $city = $_POST['city'];
            $mobile_no = $_POST['mobile_no'];

            $sql = "UPDATE contacts SET first_name='$first_name', last_name='$last_name', city='$city', mobile_no='$mobile_no' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully. <a href='users.php'>Go back to User Records</a>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // Fetch the record
            $id = $_GET['id'];
            $sql = "SELECT id, first_name, last_name, city, mobile_no FROM contacts WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form method="POST" action="update_user.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required><br>
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required><br>
                    <label for="city">City:</label>
                    <input type="text" name="city" value="<?php echo $row['city']; ?>" required><br>
                    <label for="mobile_no">Mobile No:</label>
                    <input type="text" name="mobile_no" value="<?php echo $row['mobile_no']; ?>" required><br>
                    <button type="submit">Update</button>
                </form>
                <?php
            } else {
                echo "Record not found.";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
