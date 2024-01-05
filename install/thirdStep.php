<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $website_Title = $_POST["website_Title"];
    $user_Name = $_POST["user_Name"];
    $user_Password = password_hash($_POST["user_Password"], PASSWORD_DEFAULT);
    $user_Email = $_POST["user_Email"];

    include('../connections/databaseConnection.php');

    if ($conn->connect_error) {
        die(json_encode(array("success" => false, "error" => "Error connecting to the database server: " . $conn->connect_error)));
    }

    $sqlUsers = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        userPassword VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        accessLevel INT(11) DEFAULT 1,
        active ENUM('active','inactive') DEFAULT 'active',
        signupDate DATETIME DEFAULT CURRENT_TIMESTAMP,
        updateDate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sqlUsers) !== TRUE) {
        die(json_encode(array("success" => false, "error" => $conn->error)));
    }

    $sqlInsertUser = "INSERT INTO users (username, userPassword, email) VALUES ('$user_Name', '$user_Password', '$user_Email')";

    if ($conn->query($sqlInsertUser) !== TRUE) {
        die(json_encode(array("success" => false, "error" => $conn->error)));
    }

    $sqlWebsiteData = "CREATE TABLE IF NOT EXISTS website_data (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description VARCHAR(255)
    )";

    if ($conn->query($sqlWebsiteData) !== TRUE) {
        die(json_encode(array("success" => false, "error" => $conn->error)));
    }

    $sqlInsertWebsiteData = "INSERT INTO website_data (title) VALUES ('$website_Title')";

    if ($conn->query($sqlInsertWebsiteData) !== TRUE) {
        die(json_encode(array("success" => false, "error" => $conn->error)));
    }

    $sqlContents = "CREATE TABLE IF NOT EXISTS contents (
        id INT(255) NOT NULL AUTO_INCREMENT,
        parentSubMenu INT(255) NULL DEFAULT NULL,
        content LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        evaluation INT(255) NULL DEFAULT NULL,
        createDate DATETIME NULL DEFAULT NULL,
        updateDate DATETIME NULL DEFAULT NULL,
        active ENUM('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
        PRIMARY KEY (id) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic";
    if ($conn->query($sqlContents) !== TRUE) {
        echo json_encode(array("success" => false, "error" => $conn->error));
        $conn->close();
        exit();
    }

    $sqlContents = "CREATE TABLE IF NOT EXISTS contents (
        id INT(255) NOT NULL AUTO_INCREMENT,
        parentSubMenu INT(255) NULL DEFAULT NULL,
        content LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        evaluation INT(255) NULL DEFAULT NULL,
        createDate DATETIME NULL DEFAULT NULL,
        updateDate DATETIME NULL DEFAULT NULL,
        active ENUM('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
        PRIMARY KEY (id) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic";
    if ($conn->query($sqlContents) !== TRUE) {
        echo json_encode(array("success" => false, "error" => $conn->error));
        $conn->close();
        exit();
    }

    $sqlMenus = "CREATE TABLE IF NOT EXISTS menus (
    id INT(255) NOT NULL AUTO_INCREMENT,
    menuItem VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    createDate DATETIME NULL DEFAULT NULL,
    updateDate DATETIME NULL DEFAULT NULL,
    active ENUM('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    PRIMARY KEY (id) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic";

    if ($conn->query($sqlMenus) !== TRUE) {
        echo json_encode(array("success" => false, "error" => $conn->error));
        $conn->close();
        exit();
    }

    $sqlPanelSideMenus = "CREATE TABLE IF NOT EXISTS panel_side_menus (
    id INT(11) NOT NULL AUTO_INCREMENT,
    content VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    menuItem VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    active VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    PRIMARY KEY (id) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic";

    if ($conn->query($sqlPanelSideMenus) !== TRUE) {
        echo json_encode(array("success" => false, "error" => $conn->error));
        $conn->close();
        exit();
    }

    $sqlInsertPanelSideMenus = "INSERT INTO panel_side_menus (id, content, menuItem, active)
    VALUES (1, 'homePanelContent.php', 'Home', 'active'),
    (2, 'addTopContent.php', 'Add Top Menu', 'active'),
    (3, 'addSideContent.php', 'Add Side Menu', 'active'),
    (4, 'addContent.php', 'Add Content', 'active'),
    (5, 'manageSlides.php', 'Slides', 'active')";

    if ($conn->query($sqlInsertPanelSideMenus) !== TRUE) {
        echo json_encode(array("success" => false, "error" => $conn->error));
        $conn->close();
        exit();
    }


    $sqlSideMenus = "CREATE TABLE IF NOT EXISTS side_menus (
    id INT(255) NOT NULL AUTO_INCREMENT,
    parentMenu INT(255) NULL DEFAULT NULL,
    menuItem VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    createDate DATETIME NULL DEFAULT NULL,
    updateDate DATETIME NULL DEFAULT NULL,
    active ENUM('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    PRIMARY KEY (id) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic";

    if ($conn->query($sqlSideMenus) !== TRUE) {
        echo json_encode(array("success" => false, "error" => $conn->error));
        $conn->close();
        exit();
    }

    $sqlSlides = "CREATE TABLE IF NOT EXISTS slides (
    id INT(11) NOT NULL AUTO_INCREMENT,
    src VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    alt VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    link VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    active ENUM('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    PRIMARY KEY (id) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic";

    if ($conn->query($sqlSlides) !== TRUE) {
        echo json_encode(array("success" => false, "error" => $conn->error));
        $conn->close();
        exit();
    }





    echo json_encode(array("success" => true));
    $conn->close();
    exit();
    }
?>


<script>
    function validateform() {
        return true;
    }

    function sendform() {
        if (validateform()) {
            var formData = {
                website_Title: $('#website_Title').val(),
                user_Name: $('#user_Name').val(),
                user_Password: $('#user_Password').val(),
                user_Email: $('#user_Email').val()
            };


            $.ajax({
                url: 'thirdStep.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.success) {
                        $.ajax({
                            url: 'fourthStep.php',
                            type: 'GET',
                            success: function(data) {
                                $('#installForm').html(data);
                            },
                            error: function() {
                                alert('Error loading the fourth step.');
                            }
                        });
                    } else {
                        alert('Error processing the form: ' + response.error);
                    }
                },
                error: function() {
                    alert('Error submitting the form.');
                }
            });

            return false;
        }
    }
</script>

<h2>Third Step</h2>

<form name="form" method="post" action="javascript:void(0);" onsubmit="return sendform()">
    <label class="formLabels" for="website_Title">Website Title:</label>
    <input class="formFields" type="text" id="website_Title" required>

    <label class="formLabels" for="user_Name">User Name:</label>
    <input class="formFields" type="text" id="user_Name" required>

    <label class="formLabels" for="user_Password">User Password:</label>
    <input class="formFields" type="password" id="user_Password" required>

    <label class="formLabels" for="user_Email">User Email:</label>
    <input class="formFields" type="text" id="user_Email" required>

    <input class="formButtons" type="submit" value="Enviar">
</form>