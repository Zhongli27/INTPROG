<?php

if(isset($_POST['submit'])){
  $file = $_FILES['person-image'];

 
// It should be png, gif, jpg
$allowed = ["png", "gif", "jpg"];

$extension = pathinfo($file['name'], PATHINFO_EXTENSION);

if(!in_array($extension, $allowed)){
    $error = 1;
}

if ($file['size'] > 5_000_000){
    $error = 1;
}

if(!$error){
   $target_dir = "image/";
   move_uploaded_file($file['tmp_name'], $target_dir . $file['name']);

   // save other information to the txt file
   $txt = fopen("./files/members.txt", "a") or die("unable to open file");


$data = [
    $_POST['name'],
    $_POST['age'],
    $_POST['birthday'],
    $_POST['address'],
    $_POST['description'],
    $file['name'], 
    PHP_EOL
];

$dataStr = implode(',', $data);
fwrite($txt, $dataStr);
fclose($txt);

header('Location: index.php?error=' . $error);

   }
}

?>