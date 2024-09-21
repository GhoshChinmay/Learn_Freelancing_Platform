<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hack";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch specific columns from the 'profile' table
$sql = "SELECT * from info ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row["name"];
    $user_dob = $row["dob"];
    $user_city = $row["city"];
    $user_language = $row["language"];
    $user_profession = $row["profession"];
    $user_skill = $row["skill"]; // Assuming you have a 'skill' column
    $user_weaksubject = $row["weaksubject"];
    $user_strongsubject = $row["strongsubject"];
} else {
    // Handle the case where no user is found
    $user_name = "";
    $user_dob = "";
    $user_city = "";
    $user_language = "";
    $user_profession = "";
    $user_skill = "";
    $user_weaksubject = "";
    $user_strongsubject = "";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    
    <div class="container">
        <div class="profile-header">
            <img src="profile-icon.png" alt="Profile Icon" class="profile-icon">
            <h1>Student Profile</h1>
        </div>

        <div id="profile-details">
            <h2>Personal Details</h2>
            <div class="detail-group">
                <label><strong>Name:</strong> 
                    <input type="text" id="profile-name" value="<?php echo $user_name; ?>" disabled> 
                </label>
                <label><strong>Date of Birth:</strong> 
                    <input type="text" id="profile-dob" value="<?php echo $user_dob; ?>" disabled> 
                </label>
                <label><strong>City:</strong> 
                    <input type="text" id="profile-city" value="<?php echo $user_city; ?>" disabled> 
                </label>
                <label><strong>Language:</strong> 
                    <input type="text" id="profile-language" value="<?php echo $user_language; ?>" disabled> 
                </label>
            </div>

            <h2>Education Details</h2>
            <div class="detail-group">
                <label><strong>Profession:</strong> 
                    <input type="text" id="profile-profession" value="<?php echo $user_profession; ?>" disabled>
                </label>
                <label><strong>Skill:</strong> 
                    <input type="text" id="profile-skill" value="<?php echo $user_skill; ?>" disabled>
                </label>
                <label><strong>Weak Subject:</strong> 
                    <input type="text" id="profile-weaksubject" value="<?php echo $user_weaksubject; ?>" disabled>
                </label>
                <label><strong>Strong Subject:</strong> 
                    <input type="text" id="profile-strongsubject" value="<?php echo $user_strongsubject; ?>" disabled>
                </label>
            </div>
        </div>

        <button id="edit-profile" class="btn-edit">Edit Profile</button>
        <button id="save-profile" class="btn-save" style="display: none;">Save Profile</button>
    </div>

    <script>
        // ... (your existing JavaScript code) ...
    </script>
    
</body>
</html>