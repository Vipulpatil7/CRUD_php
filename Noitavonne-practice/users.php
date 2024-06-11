<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Records</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="form_1.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="users.php">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="heading text-center my-4">
    <h1>User Records</h1>
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

    // Fetch records based on search query
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT id, first_name, last_name, city, mobile_no FROM contacts WHERE first_name LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped table-bordered'>";
        echo "<thead class='table-dark'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>City</th><th>Mobile No</th><th>Actions</th></tr></thead>";
        echo "<tbody>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["city"] . "</td><td>" . $row["mobile_no"] . "</td>";
            echo "<td><a class='btn btn-warning btn-sm' href='update_user.php?id=" . $row["id"] . "'>Edit</a> ";
            echo "<a class='btn btn-danger btn-sm' href='delete_user.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning' role='alert'>0 results</div>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>
