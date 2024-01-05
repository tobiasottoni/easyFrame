<?php

include('../connections/databaseConnection.php');


$queryMenuSide = "SELECT * FROM side_menus WHERE active = 'active' ORDER BY RAND()  LIMIT 26";
$doQueryMenuSide = mysqli_query($conn, $queryMenuSide);

if ($doQueryMenuSide) {
    echo '<ul>';  
    while ($sideMenuItens = mysqli_fetch_assoc($doQueryMenuSide)) {
        echo
        '<li class="someContentItem">
                <span class="someContentSpan" data-id="' . $sideMenuItens['id'] . '">' . $sideMenuItens['menuItem'] . '</span>               
            </li>';
    }
    echo '</ul>';
}


?>