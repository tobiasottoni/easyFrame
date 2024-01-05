<?php
include('../connections/databaseConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação e recuperação dos dados do formulário
    $menuItem = $_POST["menuItem"];
    
    // Utilização de declaração preparada para prevenir SQL injection
    $queryMenuItem = "INSERT INTO menus (menuItem, createDate, active) VALUES ('".$menuItem."', NOW(), 'active')";
    $execMenuItem = mysqli_query($conn, $queryMenuItem);

    if ($execMenuItem) {

    echo '<script>
            alert("Main Content Registered Successfully!");
            window.location.href = "../panel/index.php";
    </script>';
       
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}
?>


