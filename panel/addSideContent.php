<?php
session_start();

if ($_SESSION["accessLevel"] != 1) {
    // Usuário não tem permissão, redirecionar ou exibir mensagem
    header("Location: index.php");
    exit();
}



?>

<h2>Add Side Content</h2>
<form class="form" action="addSideContentProcess.php" method="post">

    <label class="formLabels" for="parentMenu">Parent Menu</label>
    <select class="formFields" name="parentMenu">

        <?php

        include('../connections/databaseConnection.php');

        $queryGetMenus = "SELECT * FROM menus WHERE active = 'active' ORDER BY id DESC";
        $queryGetMenusExec = mysqli_query($conn, $queryGetMenus);

        while ($menus = mysqli_fetch_array($queryGetMenusExec)) {
            echo '<option value="' . $menus['id'] . '">' . $menus['menuItem'] . '</option>';
        }

        ?>

    </select>

    <label class="formLabels" for="email">Item</label>
    <input class="formFields" type="text" name="menuItem" required>
    <input class="formButtons" type="submit" value="Create Content">
</form>

