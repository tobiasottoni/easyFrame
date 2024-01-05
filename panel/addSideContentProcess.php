<?php
include('../connections/databaseConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação e recuperação dos dados do formulário
    $parentMenu = $_POST['parentMenu'];
    $menuItem = $_POST["menuItem"];
    
    // Utilização de declaração preparada para prevenir SQL injection
    $queryMenuItem = "INSERT INTO side_menus (parentMenu, menuItem, createDate, active) VALUES ('".$parentMenu."','".$menuItem."', NOW(), 'active')";
    $execMenuItem = mysqli_query($conn, $queryMenuItem);

    if ($execMenuItem) {

    echo '<script>
            alert("Side Content Registered Successfully!");
            window.location.href = "../panel/index.php";
    </script>';
       
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}
?>


