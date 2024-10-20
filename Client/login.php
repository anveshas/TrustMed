<?php
// Start the session to handle login state
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'test1') or die("Connection failed: " . mysqli_connect_error());

    // Check if mobile number and password are set
    if (isset($_POST['number']) && isset($_POST['password'])) {

        // Sanitize user input
        $mobile = mysqli_real_escape_string($conn, trim($_POST['number']));
        $password = mysqli_real_escape_string($conn, trim($_POST['password']));

        // Check if the fields are empty
        if (empty($mobile) || empty($password)) {
            echo 'Please fill out all fields.';
            exit();
        }

        // Fetch user information from the database
        $sql = "SELECT * FROM users WHERE mobile = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $mobile);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password (assuming the password is hashed)
            if (password_verify($password, $user['password'])) {
                // Set session variables if login is successful
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user['mobile'];

                // Redirect to DocLogin.php
                header("Location: DocLogin.php");
                exit();
            } else {
                echo 'Incorrect password.';
            }
        } else {
            echo 'No user found with that mobile number.';
        }

        // Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo 'Please enter both mobile number and password.';
    }
}
?>
