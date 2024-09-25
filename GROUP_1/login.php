<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the AJAX login request
    $error = "";
    $username = htmlspecialchars($_POST['username'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');

    $username = trim($username);
    $password = trim($password);

    // Open the credentials file
    $file = fopen("./files/credentials.txt", "r");

    // Read the data from the file
    while ($row = fgets($file)) {
        $data = explode(",", $row);

        if ($username == trim($data[1]) && $password == trim($data[2])) {
            $_SESSION['username'] = $username;
            echo json_encode(['success' => true]);
            fclose($file);
            exit;
        }
    }

    $error = "error-input";
    fclose($file);

    // Return failure response if credentials are invalid
    echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Registration Page</title>
</head>
<body>
    
<div class="login-card">
    <h2>Please login</h2>
    <h3>Enter name and password</h3>

    <?php
       if($error){
        echo "<h4 class='warn'>Credentials not found</h4>";
       }
    ?>
           
  <!-- Login form -->
    <form id="login-form" class="login-form">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <a href="#">Forgot your password</a>
        <input type="submit" value="Login" name="submit">
    </form>
</div>
   
<!-- JavaScript to handle AJAX submission -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
