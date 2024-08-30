<?php
session_start();

$error = "";
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = trim(htmlspecialchars($username));
    $password = trim($password);

    //Open a file
    $file = fopen("./files/credentials.txt","r");

    //Read data from file
    while($row = fgets($file)){
         $data = explode(",",$row);

         if($username == trim($data[1]) and $password == trim($data[2])){
             $_SESSION['username'] = $username;
             header("Location: index.php");
         }
    }

    $error = "error-input";

    fclose($file);
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

    <form action="<?=$_SERVER['PHP_SELF']?>" class="login-form" method="POST">
        <input type="text" name="username" placeholder="Username" class="<?=$error?>">
        <input type="password" name="password" placeholder="Password" class="<?=$error?>">
        <a href="">Forgot your password</a>
        <input type="submit" value="Login" name="submit">
    </form>
</div>

</body>
</html>