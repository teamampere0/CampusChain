<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "admin";
$password = "123";
$dbname = "logindb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['userName'];
$password = $_POST['pwd'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if (password_verify($password, $row['password'])) {
        // Login successful, redirect to userPage.html
        header('Location: userPage.html');
        exit();
    } else {
        // Incorrect password
        echo "Incorrect password.";
    }
} else {
    // User not found
    echo "User not found.";
}

// Close the database connection
$conn->close();
?>
