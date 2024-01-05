<?php

include('../connections/databaseConnection.php');

if (isset($_POST['parentSubMenu'])) {
    $parentSubMenu = $_POST['parentSubMenu'];

    if (!$conn) {
        die("Connection Fail: " . mysqli_connect_error());
    }

    $queryContent = "SELECT * FROM contents WHERE parentSubMenu=" . $parentSubMenu . " AND active = 'active'";

    $doQueryContent = mysqli_query($conn, $queryContent);

    if ($doQueryContent) {
        while ($theContent = mysqli_fetch_assoc($doQueryContent)) {

            $myRequire = $theContent['content'];

            '<div class="singleContentDiv">';
            require_once("$myRequire");
            '</div>';


            echo '</div>';
        }
    }
}
