<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'add';
    $index = $_POST['index'] ?? null;
    $name = $_POST['username'] ?? '';
    $age = $_POST['age'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $address = $_POST['address'] ?? '';
    $description = $_POST['description'] ?? '';
    $facebook = $_POST['facebook'] ?? '';
    $github = $_POST['github'] ?? '';
    $coursera = $_POST['coursera'] ?? '';
    $udemy = $_POST['udemy'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';

    // Handle image upload
    $image = ''; // Initialize image variable

    if (isset($_FILES['person-image']) && $_FILES['person-image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['person-image']['name'];
        move_uploaded_file($_FILES['person-image']['tmp_name'], 'image/' . $image);
    }

    $members = [];
    $txt = fopen("./files/members.txt", "r") or die("unable to open file");
    
    // Read existing members
    while ($line = fgets($txt)) {
        $data = explode(',', trim($line));
        if (count($data) < 11) continue; // Skip lines with insufficient data
        $members[] = [
            'username' => $data[0] ?? '',
            'age' => $data[1] ?? '',
            'birthday' => $data[2] ?? '',
            'address' => $data[3] ?? '',
            'description' => $data[4] ?? '',
            'person-image' => $data[5] ?? '',
            'facebook' => $data[6] ?? '',
            'github' => $data[7] ?? '',
            'coursera' => $data[8] ?? '',
            'udemy' => $data[9] ?? '',
            'linkedin' => $data[10] ?? '',
        ];
    }
    fclose($txt);

    // Update or add member
    if ($action === 'edit' && $index !== null && isset($members[$index])) {
        $members[$index] = [
            'username' => $name,
            'age' => $age,
            'birthday' => $birthday,
            'address' => $address,
            'description' => $description,
            'person-image' => $image,
            'facebook' => $facebook,
            'github' => $github,
            'coursera' => $coursera,
            'udemy' => $udemy,
            'linkedin' => $linkedin,
        ];
    } elseif ($action === 'add') {
        // Ensure no empty records are added
        if (!empty($name)) {
            $members[] = [
                'username' => $name,
                'age' => $age,
                'birthday' => $birthday,
                'address' => $address,
                'description' => $description,
                'person-image' => $image,
                'facebook' => $facebook,
                'github' => $github,
                'coursera' => $coursera,
                'udemy' => $udemy,
                'linkedin' => $linkedin,
            ];
        }
    }

    // Write updated data back to file
    $txt = fopen("./files/members.txt", "w") or die("unable to open file");
    foreach ($members as $member) {
        // Avoid writing incomplete data
        if (array_filter($member)) {
            fwrite($txt, implode(',', $member) . "\n");
        }
    }
    fclose($txt);

    header("Location: index.php");
    exit;
}
