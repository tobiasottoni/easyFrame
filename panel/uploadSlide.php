<?php
include('../connections/databaseConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Upload directory
    $uploadDir = '../public/images/slides/';

    // Check if the upload directory exists; if not, try to create it
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die('Failed to create the upload directory...');
        }
    }

    // Retrieve form data
    $alt = $_POST["alt"];
    $link = $_POST["link"];
    $active = 'active';

    // Original file name
    $originalFileName = basename($_FILES['image']['name']);

    // Generate a unique name for the file (can be improved as needed)
    $uniqueFileName = time() . '_' . $originalFileName;

    // Full path of the new file
    $uploadFile = $uploadDir . $uniqueFileName;

    // Move the file to the upload directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        // Insert into the database
        $sqlInsertSlide = "INSERT INTO slides (src, alt, link, active) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlInsertSlide);
        $stmt->bind_param("ssss", $uploadFile, $alt, $link, $active);

        if ($stmt->execute()) {
            echo '<script>
            alert("Successfully Uploaded!");
            window.location.href = "../panel/index.php";
            </script>';
        } else {
            echo "Error adding the slide: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Upload error: Failed to move the file.";
    }

    $conn->close();
}
?>
