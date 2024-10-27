<?php
include("includes/config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the AJAX login request
    $error = "";
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'] ?? ''));
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password'] ?? ''));

    $username = trim($username);
    $password = trim($password);

   $sql = "SELECT * FROM admin WHERE username ='$username' and password = '$password'";

   $result = mysqli_query($db,$sql);
   $row = mysqli_num_rows($result);
   $count = mysqli_num_rows($result);



        if ($count == 1) {
            $_SESSION['username'] = $username;
            
            // Set a cookie that lasts for 1 hour
            setcookie("username", $username, time() + 3600, "/");

            echo json_encode(['success' => true]);
            exit;
        }else{
            // Return failure response if credentials are invalid
            echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
            exit;
        }
    
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Page</title>
</head>
<body>
    
<div class="login-card">
    <h2>Please login</h2>
    <h3>Enter name and password</h3>

    <!-- Error message container -->
    <div id="error-message" class="warn"></div>

    <!-- Login form -->
    <form id="login-form" class="login-form">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <a href="#">Forgot your password</a>
        <input type="submit" value="Login" name="submit">
    </form>
</div>

<!-- JavaScript to handle AJAX submission -->
<script>
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent traditional form submission

    var formData = new FormData(this); // Collect form data

    // Send AJAX request using fetch
    fetch('', { // Send the request to the same PHP file
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Parse JSON response
    .then(data => {
        if (data.success) {
            window.location.href = 'index.php'; // Redirect if login is successful
        } else {
            document.getElementById('error-message').style.display = 'block';
            document.getElementById('error-message').textContent = data.error; // Show error message
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
</body>
</html>
