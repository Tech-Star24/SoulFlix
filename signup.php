<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "souldb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print ("Connection failed:  $conn->connect_error");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];


    if (strlen($username) < 3) {
        echo "<script>alert('Username must be at least 3 characters long.'); window.location.href='signup.html';</script>";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href='signup.html';</script>";
        exit;
    }
    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.'); window.location.href='signup.html';</script>";
        exit;
    }
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href='signup.html';</script>";
        exit;
    }


    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered. Please use a different email.'); window.location.href='signup.html';</script>";
        exit;
    }


    $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration successful! You will be redirected to the login page.');
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 1000); // Redirects after 3 seconds
              </script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='signup.html';</script>";
    }
}
$conn->close();

