<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Homepage</title>

    
</head>
<body>

<nav>
    <h1>Our Team Members</h1>
<ul>
    <li><a href="index.php">Home</a></li> 
    <li><a href="login.php">Login</a></li>
</ul>
</nav>

<!--<h1>Welcome <?=$_SESSION['username']?></h1>-->

<div class="main-container">
    <div class="add-new">Add New Member <button class="btn add-new-btn">Add</button></div>

    <?php
        $txt = fopen("./files/members.txt", "r") or die("unable to open file");
        
        $members = [];
        while($line = fgets($txt)){
            $data = explode(',', $line);

            $member = [
                'name' => $data[0],
                'age' => $data[1],
                'birthday' => $data[2],
                'address' => $data[3],
                'description' => $data[4],
                'person-image' => $data[5] ?? '',
            ];

            array_push($members, $member);
            //$members[] = $member;
        }

        
   

 fclose($txt);
    ?>  

   
    

    <table class="main-list">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Age</th>
                <th>Birthday</th>
                <th>Address</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($members as $member): ?>
            <tr>
                <td><img src="image/<?=$member['person-image']?>" class="photo"></td>
                <td><?=$member['name']?></td>
                <td><?=$member['age']?></td>
                <td><?=$member['birthday']?></td>
                <td><?=$member['address']?></td>
                <td><?=$member['description']?></td>
                <td><a href="edit.php?index=<?=$index?>">Edit</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<div class="modal-container">
    <div class="modal-content">
    <a class="window-close">x</a>
        <h2>Add Member Details</h2>
        <div>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
             <form-group>
                <label for="name">Name</label>
                <input type="text" name="name">
             </form-group>
             <form-group>
                <label for="age">Age</label>
                <input type="text" name="age">
             </form-group>
             <form-group>
                <label for="birthday">Birthday</label>
                <input type="text" name="birthday">
             </form-group>
             <form-group>
                <label for="address">Address</label>
                <input type="text" name="address">
             </form-group>
             <form-group>
                <label for="description">Description</label>
                <textarea name="description" cols="30" rows="10"></textarea>
             </form-group>
             <form-group>
                <label for="person-image">Image</label>
                <input type="file" name="person-image">
             </form-group>
             <input type="submit" value="Submit" name="submit">
            </form>
        </div>
    </div>
</div>
<script>
        const addNew = document.querySelector('.add-new-btn');
        const modal = document.querySelector('.modal-container');
        const closeModal = document.querySelector('.window-close');
        const body = document.querySelector('body');

        addNew.addEventListener('click', function(){
            modal.style.display='block';
        });

        closeModal.addEventListener('click', function(){
            modal.style.display='none';
        });     
</script>
</body>
</html>