<?php
error_reporting(0);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Homepage</title>
</head>
</style>
<body>


<header class="header">
    <nav class="navbar">
    <a href="index.php">Home</a>
    <a href="#">Dashboard</a>
    <a href="#">Banner</a>
    <a href="#">Settings</a>
    <a href="logout.php">Logout</a>
    </nav>
</header>


      

<main class="table">
    <section class="table_header">
<h1 class="add-new">Add New Member <button class="btn add-new-btn"><i class="fas fa-plus"></i></button></h1>
    <section>

    <?php
        $txt = fopen("./files/members.txt", "r") or die("unable to open file");
        
        $members = [];
        while ($line = fgets($txt)) {
            $data = explode(',', $line);

            $member = [
                'username' => $data[0],
                'age' => $data[1],
                'birthday' => $data[2],
                'address' => $data[3],
                'description' => $data[4],
                'person-image' => $data[5],
                'facebook' => $data[6] ?? '',
                'github' => $data[7] ?? '',
                'coursera' => $data[8] ?? '',
                'udemy' => $data[9] ?? '',
                'linkedin' => $data[10] ?? '',
                 PHP_EOL
            ];

            array_push($members, $member);
        }

        fclose($txt);
    ?>  

    <section class="table_body">
        <table>
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
            <td>
                    <?php if (!empty($member['person-image'])): ?>
                        <img src="image/<?=$member['person-image']?>" class="photo" alt="Member Image">
                    <?php else: ?>
                        <img src="image/empty.jpg" class="photo" alt="Default Image">
                    <?php endif; ?>
                </td>

                <td><?=$member['username']?></td>
                <td><?=$member['age']?></td>
                <td><?=$member['birthday']?></td>
                <td><?=$member['address']?></td>
                <td><?=$member['description']?></td>
                <td class="account-icons">
                    <?php if (!empty($member['facebook'])): ?>
                        <a href="<?=$member['facebook']?>" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQKrFhY-ljA-u7J5IMWeTv8zmpBx4PP9nQMw&s" alt=""></a>
                    <?php endif; ?>
                    <?php if (!empty($member['github'])): ?>
                        <a href="<?=$member['github']?>" target="_blank"><img src="data:image/png;base64,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" alt=""></a>
                    <?php endif; ?>
                    <?php if (!empty($member['coursera'])): ?>
                        <a href="<?=$member['coursera']?>" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmq3j8rE52zvrNxhzXfyxoO-ttlltqXncCQA&s" alt="Coursera"></a>
                    <?php endif; ?>
                    <?php if (!empty($member['udemy'])): ?>
                        <a href="<?=$member['udemy']?>" target="_blank"><img src="https://pbs.twimg.com/profile_images/1417157967124721666/xShJF4Km_400x400.png" alt="Udemy"></a>
                    <?php endif; ?>
                    <?php if (!empty($member['linkedin'])): ?>
                        <a href="<?=$member['linkedin']?>" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="LinkedIn"></a>
                    <?php endif; ?>    
                </td>
                <td>
                    <button class="btn edit-btn" data-index="<?=$index?>" data-name="<?=$member['username']?>" data-age="<?=$member['age']?>" data-birthday="<?=$member['birthday']?>" data-address="<?=$member['address']?>" data-description="<?=$member['description']?>" data-image="<?=$member['person-image']?>" data-facebook="<?=$member['facebook']?>" data-github="<?=$member['github']?>" data-coursera="<?=$member['coursera']?>" data-udemy="<?=$member['udemy']?>" data-linkedin="<?=$member['linkedin']?>"><i class="fas fa-edit"></i></button>
                    <a style="text-decoration:none;" href="profile.php?index=<?=$index?>" class="btn"><i class="fas fa-eye"></i></a>
                 <form action="delete.php" method="POST" style="display:inline;">
            <input type="hidden" name="index" value="<?=$index?>">
            <input type="submit" value="&#xf00d;" class="btn delete-btn fa fa-trash">
        </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </section>
</main>

<div class="modal-container" style="display: none;">
    <div class="modal-content">
        <a class="window-close">x</a>
        <h2 id="modal-title">Add Member Details</h2>
        <form id="member-form" action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" id="form-action" value="add">
            <input type="hidden" name="index" id="member-index">
            <div class="form-group">
                <label for="username">Name</label>
                <input type="text" name="username" id="username">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            document.getElementById('username').value = name;
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

     $(document).ready(function() {
        $('#member-form').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this); // Create FormData object

            $.ajax({
                url: 'upload.php', // URL to send the form data to
                type: 'POST',
                data: formData,
                contentType: false, // Important for file upload
                processData: false, // Important for file upload
                success: function(response) {
                    alert('Member details submitted successfully!');
                    modal.style.display = 'none'; // Close the modal
                    location.reload(); // Reload the page to see changes
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>
</body>
</html>
