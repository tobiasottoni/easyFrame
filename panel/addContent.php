<?php
session_start();

if ($_SESSION["accessLevel"] != 1) {
    // Usuário não tem permissão, redirecionar ou exibir mensagem
    header("Location: index.php");
    exit();
}



?>


<h2>Add Content</h2>
<form class="form" action="addContentProcess.php" method="post">

    <label class="formLabels" for="parentSubMenu">Parent Menu</label>
    <select class="formFields" name="parentSubMenu">

        <?php

        include('../connections/databaseConnection.php');

        $queryGetMenus = "SELECT side_menus.*, menus.menuItem as parent FROM side_menus INNER JOIN menus WHERE side_menus.parentMenu = menus.id AND side_menus.active = 'active' ORDER BY id DESC";

        $queryGetMenusExec = mysqli_query($conn, $queryGetMenus);

        while ($menus = mysqli_fetch_array($queryGetMenusExec)) {
            echo '<option value="' . $menus['id'] . '">' .$menus['parent'] .' - '. $menus['menuItem'] . '</option>';
        }

        ?>

    </select>

    <label class="formLabels" for="content">Content</label>
    <input class="formFields" name="content">


    <input class="formButtons" type="submit" value="Create Content">
</form>

