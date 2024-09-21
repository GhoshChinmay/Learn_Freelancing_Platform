<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ... (Database connection details remain the same)

    // Create a connection
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "hack";
    $con = mysqli_connect($server, $username, $password, $database);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error()); 
    }

    // ... (Connection check remains the same)

    // Get data from the form, escaping special characters
    
    $firstname = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);   

    $password = mysqli_real_escape_string($con, $_POST['password']);   


    // Hash the password
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query using prepared statements
    $stmt = $con->prepare("INSERT INTO user2 (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);

    if ($stmt->execute()) {
        echo "Successfully inserted";
        // ... (Optional redirect)
    } else {
        // More specific error handling
        if ($stmt->errno === 1062) { // Duplicate entry error
            echo "Error: Email already exists.";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
    }

    // Close the statement and the connection
    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="sign.css">
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="#" method="POST">
            <label for="firstName" class="label1">First Name</label>
            <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" required>

            <label for="lastName" class="label2">Last Name</label>
            <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" required>

            <label for="email" class="label3">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password" class="label4">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <input type="submit" value="Sign Up" class="btn">
            <p>Already have an account ? <a href="./login.php">Log In</a></p>
        </form>
    </div>
</body>
</html>
