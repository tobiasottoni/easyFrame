<?php
include('../connections/databaseConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $userPassword = password_hash($_POST["userPassword"], PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $accessLevel = 2;
    $active = 'active';

    $query = "INSERT INTO users (username, userPassword, email, accessLevel, active, signupDate) 
              VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $userPassword, $email, $accessLevel, $active);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {

        echo '<script>
            alert("Registered Successfully! Now you are able to make login!");
            window.location.href = "../index.php";
    </script>';
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

?>
