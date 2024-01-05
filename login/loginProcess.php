<?php
include('../connections/databaseConnection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $userPassword = $_POST["userPassword"];

    $query = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result && $user = mysqli_fetch_assoc($result)) {
        $storedPasswordHash = $user["userPassword"];
      
        if (password_verify($userPassword, $storedPasswordHash)) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["accessLevel"] = $user["accessLevel"];
            $_SESSION["active"] = $user["active"];

            echo '<script>
            alert("Login Successfully!");
            window.location.href = "../panel/index.php";
            </script>';
        } else {
            echo "Wrong Password!";
        }
    } else {
        echo "User Not Found!";
    }

    mysqli_stmt_close($stmt);
}
