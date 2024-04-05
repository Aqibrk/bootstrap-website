<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "aqibkhan");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables for form fields
$id = $fname = $lname = $email = $user_id = $password = $role = $company_name = $company_address = '';
$profile_image = '';

// Check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
    // Get the ID from the URL and sanitize it
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Define the SQL query to select data from the cellar_details table based on the ID
    $sql = "SELECT * FROM `aqib` WHERE id = '$id'";

    // Execute the query and check for errors
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        // Check if there are any rows returned by the query
        if (mysqli_num_rows($result) > 0) {
            // Fetch the data as an associative array
            $row = mysqli_fetch_assoc($result);

            // Assign fetched data to variables
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $user_id = $row['user_id'];
            $password = $row['password'];
            $role = $row['role'];
            // $company_name = $row['company_name'];
            // $company_address = $row['company_address'];
            // $profile_image = $row['profile_image'];
        } else {
            echo "No data found for ID: " . $id;
        }
    }
} else {
    echo "ID parameter not found in the URL";
}

session_start();
if (!isset($_SESSION["id"])) {
    echo "Session expired or not logged in.";
    exit();
}

// Check if the form is submitted for updating the profile
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Sanitize and store form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $company_address = mysqli_real_escape_string($conn, $_POST['company_address']);

    // Validate form data
    if (empty($fname) || empty($lname) || empty($email) || empty($user_id) || empty($password) || empty($role) || empty($company_name) || empty($company_address)) {
        echo "Error: All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
    } else {
        // Use prepared statement to update data in the cellar_details table
        $stmt = mysqli_prepare($conn, "UPDATE `cellar_details` SET fname=?, lname=?, email=?, user_id=?, password=?, role=?, company_name=?, company_address=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssssssssi", $fname, $lname, $email, $user_id, $password, $role, $company_name, $company_address, $id);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            // Redirect to a success page or back to the profile page
            header("Location: profile.php?id=$id");
            exit();
        } else {
            echo "Error: Unable to execute the query.";
        }
    }
}

// Check if the form is submitted for deleting the profile
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Sanitize and store form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Use prepared statement to delete data from the cellar_details table
    $stmt = mysqli_prepare($conn, "DELETE FROM `cellar_details` WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // Redirect to a success page or back to a landing page
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Unable to execute the query.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        h1 {
            margin-bottom: 5px;
        }
        p {
            margin-bottom: 10px;
        }
        .details-section {
            border-top: 2px solid #ccc;
            padding-top: 20px;
        }
        .details-section h2 {
            margin-bottom: 10px;
        }
        .details-section p {
            margin-bottom: 5px;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Profile Information Display -->
        <div class="profile-section">
            <!-- Display profile image -->
            <img src='profile_images/<?php echo $profile_image; ?>' alt='Profile Image' width='100'>
            <h1>User Profile</h1>
            <p>User Bio: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="details-section">
            <h2>Name: <?php echo $fname . ' ' . $lname; ?></h2>
            <p>Company Name: <?php echo $company_name; ?></p>
            <h2>Company Details: <?php echo $lname; ?></h2>
            <p>Company Name: <?php echo $company_name; ?></p>
            <p>Company Address: <?php echo $company_address; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>User ID: <?php echo $user_id; ?></p>
        </div>
        <!-- Profile Information Update Form -->
        <div>
            <h3 class="text-center">Edit Profile</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <!-- Populate form fields with existing data -->
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>"><br><br>

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>"><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" value="<?php echo $user_id; ?>"><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br><br>

                <label for="role">Role:</label>
                <input type="text" id="role" name="role" value="<?php echo $role; ?>"><br><br>

                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" value="<?php echo $company_name; ?>" required><br><br>

                <label for="company_address">Company Address:</label>
                <textarea id="company_address" name="company_address" required><?php echo $company_address; ?></textarea><br><br>

                <label for="profile_image">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image"><br><br>

                <!-- Terms and Conditions checkbox -->
                <input type="checkbox" id="terms_conditions" name="terms_conditions" required>
                <label for="terms_conditions">I agree to the Terms and Conditions</label><br><br>

                <!-- Update and Delete buttons -->
                <input type="submit" name="update" value="Update">
                <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete your profile?')">
            </form>
        </div>
    </div>
</body>

</html>
