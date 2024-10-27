
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index']); // Get the index from the POST request

    // Read members from the file
    $filename = './files/members.txt';
    $members = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Check if the index is valid
    if ($index >= 0 && $index < count($members)) {
        // Remove the member at the specified index
        unset($members[$index]);

        // Re-index the array
        $members = array_values($members);

        // Write the updated members back to the file
        file_put_contents($filename, implode("\n", $members) . "\n");

        // Redirect to the homepage or another page
        header('Location: index.php');
        exit();
    } else {
        // If the index is invalid, redirect with an error message or handle it accordingly
        echo 'Invalid member index.';
        exit();
    }
} else {
    // If not a POST request, redirect to the homepage or another page
    header('Location: index.php');
    exit();
}
?>
