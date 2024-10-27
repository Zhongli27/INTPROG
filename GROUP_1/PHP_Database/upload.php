<?php
include("includes/config.php");

$response = []; // Initialize response array

if ($_POST['action'] == 'edit') {
    $index = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $facebook = $_POST['facebook'];
    $github = $_POST['github'];
    $coursera = $_POST['coursera'];
    $udemy = $_POST['udemy'];
    $linkedin = $_POST['linkedin'];

    // First, fetch the existing member data to retain the old image URL if no new image is uploaded
    $query = "SELECT image_path FROM members WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $index);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_url = $row['image_path']; // Store the existing image URL
    }

    // Handle the image upload
    if (isset($_FILES['person-image']) && $_FILES['person-image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "image/"; // Directory to save uploaded images
        $target_file = $target_dir . basename($_FILES["person-image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        $check = getimagesize($_FILES["person-image"]["tmp_name"]);
        if ($check !== false) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["person-image"]["tmp_name"], $target_file)) {
                $image_url = $target_file; // Update image URL to the new file path
            } else {
                $response['success'] = false;
                $response['message'] = "Sorry, there was an error uploading your file.";
                echo json_encode($response);
                exit; // Exit if file upload fails
            }
        } else {
            $response['success'] = false;
            $response['message'] = "File is not an image.";
            echo json_encode($response);
            exit; // Exit if not a valid image
        }
    }

    // Prepare your update query with image URL
    $sql = "UPDATE members SET name=?, age=?, birthday=?, address=?, description=?, facebook=?, github=?, coursera=?, udemy=?, linkedin=?, image_path=? WHERE id=?";
    $stmt = $db->prepare($sql);
    
    // Bind parameters (image_url will now retain its value if no new image is uploaded)
    $stmt->bind_param("sisssssssssi", $name, $age, $birthday, $address, $description, $facebook, $github, $coursera, $udemy, $linkedin, $image_url, $index);
    
    if ($stmt->execute()) {
        // Check for success
        if ($stmt->affected_rows > 0) {
            $response['success'] = true;
            $response['message'] = "Member updated successfully.";
        } else {
            // No rows affected
            $response['success'] = false;
            $response['message'] = "No changes made to the member information.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating member: " . $stmt->error; // Include SQL error for debugging
    }

} elseif ($_POST['action'] == 'add') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $facebook = $_POST['facebook'];
    $github = $_POST['github'];
    $coursera = $_POST['coursera'];
    $udemy = $_POST['udemy'];
    $linkedin = $_POST['linkedin'];

    // Handle the image upload for adding a new member
    $image_url = ''; // Initialize image URL
    if (isset($_FILES['person-image']) && $_FILES['person-image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "image/"; // Directory to save uploaded images
        $target_file = $target_dir . basename($_FILES["person-image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        $check = getimagesize($_FILES["person-image"]["tmp_name"]);
        if ($check !== false) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["person-image"]["tmp_name"], $target_file)) {
                $image_url = $target_file; // Update image URL to the new file path
            } else {
                $response['success'] = false;
                $response['message'] = "Sorry, there was an error uploading your file.";
                echo json_encode($response);
                exit; // Exit if file upload fails
            }
        } else {
            $response['success'] = false;
            $response['message'] = "File is not an image.";
            echo json_encode($response);
            exit; // Exit if not a valid image
        }
    }

    // Prepare your insert query
    $sql = "INSERT INTO members (name, age, birthday, address, description, facebook, github, coursera, udemy, linkedin, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    
    // Bind parameters for insert
    $stmt->bind_param("sisssssssss", $name, $age, $birthday, $address, $description, $facebook, $github, $coursera, $udemy, $linkedin, $image_url);
    
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "New member added successfully.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error adding member: " . $stmt->error; // Include SQL error for debugging
    }
}

// Return JSON response
echo json_encode($response);
?>
