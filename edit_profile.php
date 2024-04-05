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
    $sql = "SELECT * FROM `cellar_details` WHERE id = '$id'";

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
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $user_id = $row['user_id'];
            $password = $row['password'];
            $role = $row['role'];
            $company_name = $row['company_name'];
            $company_address = $row['company_address'];
            $profile_image = $row['profile_image'];
        } else {
            echo "No data found for ID: " . $id;
        }
    }
} else {
    echo "ID parameter not found in the URL";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Update the profile data using prepared statement
    $stmt = mysqli_prepare($conn, "UPDATE `cellar_details` SET fname=?, lname=?, email=?, user_id=?, password=?, role=?, company_name=?, company_address=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssssssss", $fname, $lname, $email, $user_id, $password, $role, $company_name, $company_address, $id);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // Redirect to a success page or the profile listing page
        header("Location: cellar.php");
        exit();
    } else {
        echo "Error: Unable to update the profile.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
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
        <input type="text" id="company_name" name="company_name" value="<?php echo $company_name; ?>"><br><br>

        <label for="company_address">Company Address:</label>
        <textarea id="company_address" name="company_address"><?php echo $company_address; ?></textarea><br><br>

        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
