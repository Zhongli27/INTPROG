<?php
session_start();
$index = $_GET['index'] ?? null;

if ($index === null) {
    die("No index provided");
}

$txt = fopen("./files/members.txt", "r") or die("unable to open file");

$members = [];
while ($line = fgets($txt)) {
    $data = explode(',', $line);
    $members[] = [
        'name' => $data[0],
        'age' => $data[1],
        'birthday' => $data[2],
        'address' => $data[3],
        'description' => $data[4],
        'person-image' => $data[5] ?? '',
        'facebook' => $data[6] ?? '',
        'github' => $data[7] ?? '',
        'coursera' => $data[8] ?? '',
        'udemy' => $data[9] ?? '',
        'linkedin' => $data[10] ?? '',
    ];
}

fclose($txt);

if (!isset($members[$index])) {
    die("Member not found");
}

$member = $members[$index];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="card" id="myCard">
        <div class="wrapper">
            <div class="profile">
            <img src="image/<?=$member['person-image']?>" class="photo" alt="<?=$member['name']?>">
            </div>
            <h2><?=$member['name']?></h2>
            <p><?=$member['description']?></p>
            <p>
            <?php if (!empty($member['facebook'])): ?><a href="<?=$member['facebook']?>" target="_blank"><i class="fab fa-facebook"></i></a><?php endif; ?>
            <?php if (!empty($member['github'])): ?><a href="<?=$member['github']?>" target="_blank"><i class="fab fa-github"></i></a><?php endif; ?>
            <?php if (!empty($member['coursera'])): ?><a href="<?=$member['coursera']?>" target="_blank"><img style="width:20px; height:15px; border-radius:50%;" src="https://facts.net/wp-content/uploads/2024/03/12-facts-you-must-know-about-coursera-application-1709395822.jpg" alt=""></a><?php endif; ?>
            <?php if (!empty($member['udemy'])): ?><a href="<?=$member['udemy']?>" target="_blank"><img style="width:20px; height:15px; border-radius:50%;" src="https://pbs.twimg.com/profile_images/1417157967124721666/xShJF4Km_400x400.png" alt=""></a><?php endif; ?>
                <?php if (!empty($member['linkedin'])): ?><a href="<?=$member['linkedin']?>" target="_blank"><img style="width:20px; height:15px; border-radius:50%;" src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt=""></a><?php endif; ?>   
          </p>
        <a href="index.php" class="btn">Back</a>
        </div>
    </div>

    <script>
	var card = document.getElementById("myCard");

// Set the initial transform property
card.style.transform = "perspective(500px)";

// Set the hover transform property
card.onmouseover = function() {
  card.style.transform = "perspective(500px) rotateX(10deg)";
};

// Reset the transform property on mouseout
card.onmouseout = function() {
  card.style.transform = "perspective(500px)";
};
    </script>
</body>
</html>