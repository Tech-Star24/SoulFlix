if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];


    if (strlen($username) < 3) {
        echo "Username must be at least 3 characters long.";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters long.";
        exit;
    }
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }


    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "Email already registered. Please use a different email.";
        exit;
    }


    $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}