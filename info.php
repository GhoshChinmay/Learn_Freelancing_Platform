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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values (matching the form field names)
    $name = $_POST['name'];
    $dateofbirth = $_POST['dob'];
    $city = $_POST['city'];
    $language = $_POST['language'];
    $profession = $_POST['profession'];
    $skill = $_POST['skill'];
    $weaksubject = $_POST['weaksubject'];
    $strongsubject = $_POST['strongsubject'];

    // Validate input values
    if (empty($dateofbirth)) {
        $dateofbirth = '0000-00-00'; // Set a default value for dob
    }

    // Insert data into database (using prepared statements for security)
    $stmt = $conn->prepare("INSERT INTO `info` (name, dob, city, language, profession, skill, weaksubject, strongsubject) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $dateofbirth, $city, $language, $profession, $skill, $weaksubject, $strongsubject);

    if ($stmt->execute()) {
        //echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details Form</title>
    <link rel="stylesheet" href="info.css">
</head>

<body>
    <div class="form-container">
        <h1>PROFILE</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- Upper Section -->
            <div class="form-up">
                <h1 class="headup">Personal Information</h1>
                <div class="row1">
                    <label for="name" class="label1">Name <span class="required">*</span></label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>

                    <label for="date" class="label1">Date Of Birth <span class="required">*</span></label>
                    <input type="date" id="dob" name="dob" placeholder="DD/MM/YYYY" required>
                </div>
                <div class="row2">
                    <label for="name" class="label2">City</label>
                    <input type="text" id="city" name="city" placeholder="Enter your City">

                    <label for="text" class="label2">Language</label>
                    <input type="text" id="language" name="language" placeholder="Mother language">
                </div>
            </div>

            <!-- Lower Section (Address Fields) -->
            <div class="form-up">
                <h1 class="headup">Education</h1>
                <div class="row1">
                    <label for="name" class="label1">Profession</label>
                    <input type="text" id="profession" name="profession" placeholder="Enter your profession" required>

                    <label for="date" class="label1">Skill</label>
                    <input type="text" id="skill" name="skill" placeholder="Enter your skills" required>
                </div>
                <div class="row2">
                    <label for="name" class="label2">Strong</label>
                    <input type="text" id="strongsubject" name="strongsubject" placeholder="Subjects">

                    <label for="text" class="label2">Weak</label>
                    <input type="text" id="weaksubject" name="weaksubject" placeholder="Subjects">
                </div>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>