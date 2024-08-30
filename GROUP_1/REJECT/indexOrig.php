<?php

session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, molestias?

<nav style="display:none">
    <h1>Our Team Members</h1>
    <ul>
        <li><a href="index.php">Home</a></li> 
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="main-container">
<div class="add-new">Add New Member <button class="btn add-new-btn">Add</button></div>

    <?php
        $txt = fopen("./files/members.txt", "r") or die("unable to open file");
        
        $members = [];
        while ($line = fgets($txt)) {
            $data = explode(',', $line);

            $member = [
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

            array_push($members, $member);
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
                <th>Accounts</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $index => $member): ?>
            <tr>
                <td><img src="image/<?=$member['person-image']?>" class="photo"></td>
                <td><?=$member['name']?></td>
                <td><?=$member['age']?></td>
                <td><?=$member['birthday']?></td>
                <td><?=$member['address']?></td>
                <td><?=$member['description']?></td>
                <td>
                    <?php if (!empty($member['facebook'])): ?><a href="<?=$member['facebook']?>" target="_blank"><i class="fab fa-facebook"></i></a><?php endif; ?>
                    <?php if (!empty($member['github'])): ?><a href="<?=$member['github']?>" target="_blank"><i class="fab fa-github"></i></a><?php endif; ?>
                    <?php if (!empty($member['coursera'])): ?><a href="<?=$member['coursera']?>" target="_blank"><img style="width:20px; height:15px; border-radius:50%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmq3j8rE52zvrNxhzXfyxoO-ttlltqXncCQA&s" alt=""></a><?php endif; ?>
                    <?php if (!empty($member['udemy'])): ?><a href="<?=$member['udemy']?>" target="_blank"><img style="width:20px; height:15px; border-radius:50%;" src="https://pbs.twimg.com/profile_images/1417157967124721666/xShJF4Km_400x400.png" alt=""></a><?php endif; ?>
                    <?php if (!empty($member['linkedin'])): ?><a href="<?=$member['linkedin']?>" target="_blank"><img style="width:20px; height:15px; border-radius:50%;" src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt=""></a><?php endif; ?>    
                </td>
                <td>
                    <button class="btn edit-btn" data-index="<?=$index?>" data-name="<?=$member['name']?>" data-age="<?=$member['age']?>" data-birthday="<?=$member['birthday']?>" data-address="<?=$member['address']?>" data-description="<?=$member['description']?>" data-image="<?=$member['person-image']?>" data-facebook="<?=$member['facebook']?>" data-github="<?=$member['github']?>" data-coursera="<?=$member['coursera']?>" data-udemy="<?=$member['udemy']?>" data-linkedin="<?=$member['linkedin']?>">Edit</button>
                    <a style="text-decoration:none;" href="view.php?index=<?=$index?>" class="btn">View</a>
                    <form action="delete.php" method="POST" style="display:inline;">
                        <input type="hidden" name="index" value="<?=$index?>">
                        <input type="submit" value="Delete" class="btn delete-btn">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal-container" style="display: none;">
    <div class="modal-content">
        <a class="window-close">x</a>
        <h2 id="modal-title">Add Member Details</h2>
        <form id="member-form" action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" id="form-action" value="add">
            <input type="hidden" name="index" id="member-index">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" name="age" id="age">
            </div>
            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="text" name="birthday" id="birthday">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address">
            </div>
            <div class="form-group">
                <label for="facebook">Facebook</label>
                <input type="url" name="facebook" id="facebook">
            </div>
            <div class="form-group">
                <label for="github">GitHub</label>
                <input type="url" name="github" id="github">
            </div>
            <div class="form-group">
                <label for="coursera">Coursera</label>
                <input type="url" name="coursera" id="coursera">
            </div>
            <div class="form-group">
                <label for="udemy">Udemy</label>
                <input type="url" name="udemy" id="udemy">
            </div>
            <div class="form-group">
                <label for="udemy">Linkedin</label>
                <input type="url" name="linkedin" id="linkedin">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="person-image">Image</label>
                <input type="file" name="person-image" id="person-image">
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>

<script>
    const addNewBtn = document.querySelector('.add-new-btn');
    const modal = document.querySelector('.modal-container');
    const closeModal = document.querySelector('.window-close');
    const editBtns = document.querySelectorAll('.edit-btn');
    const form = document.getElementById('member-form');
    const formTitle = document.getElementById('modal-title');
    const actionInput = document.getElementById('form-action');
    const indexInput = document.getElementById('member-index');

    addNewBtn.addEventListener('click', function() {
        formTitle.textContent = 'Add Member Details';
        actionInput.value = 'add';
        indexInput.value = '';
        form.reset();
        modal.style.display = 'block';
    });

    editBtns.forEach(button => {
        button.addEventListener('click', function() {
            const index = button.getAttribute('data-index');
            const name = button.getAttribute('data-name');
            const age = button.getAttribute('data-age');
            const birthday = button.getAttribute('data-birthday');
            const address = button.getAttribute('data-address');
            const description = button.getAttribute('data-description');
            const image = button.getAttribute('data-image');
            const facebook = button.getAttribute('data-facebook');
            const github = button.getAttribute('data-github');
            const coursera = button.getAttribute('data-coursera');
            const udemy = button.getAttribute('data-udemy');
            const linkedin = button.getAttribute('data-linkedin');


            formTitle.textContent = 'Edit Member Details';
            actionInput.value = 'edit';
            indexInput.value = index;

            document.getElementById('name').value = name;
            document.getElementById('age').value = age;
            document.getElementById('birthday').value = birthday;
            document.getElementById('address').value = address;
            document.getElementById('description').value = description;
            document.getElementById('facebook').value = facebook;
            document.getElementById('github').value = github;
            document.getElementById('coursera').value = coursera;
            document.getElementById('udemy').value = udemy;
            document.getElementById('linkedin').value = linkedin;
            modal.style.display = 'block';
        });
    });

   
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
</script>
</body>
</html>
