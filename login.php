<?php
// Configuration
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'hack';

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM user2 WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Set parameters
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Execute query
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if query returns any rows
    if ($result->num_rows > 0) {
        // Login successful, fetch user data
        $user_data = $result->fetch_assoc();
        // Check if the "name" column exists in the result
        if (isset($user_data['name'])) {
            echo "Login successful! Welcome, " . $user_data['name'] . "!";
        } 
        // Redirect to info.html
        header("Location: info.html");
        exit;
    } else {
        echo "Invalid email or password";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
 
    <div class="login-container">
        <h1>Login </h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="email" class="label1">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password" class="label2">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <input type="submit" value="Login" class="label3">
        </form>

        <p>Don't have an account? <a href="./index.php">Sign Up</a></p>
    </div>
</body>
</html>