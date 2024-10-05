<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "souldb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Escape email to prevent SQL injection
    $email = $conn->real_escape_string($email);

    // Query to fetch the user data
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password entered by the user with the hashed password in the database
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            echo "<script>alert('Login successful!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.'); window.location.href='login.html';</script>";
    }
}

$conn->close();
?>