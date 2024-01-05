<?php
include('../connections/databaseConnection.php');


$queryMenuSide = "SELECT * FROM panel_side_menus WHERE active = 'active'";
$doQueryMenuSide = mysqli_query($conn, $queryMenuSide);

if ($doQueryMenuSide) {
    // Processar os resultados
    echo '<ul>';  // Início da lista
    while ($sideMenuItens = mysqli_fetch_assoc($doQueryMenuSide)) {
        echo
        '<li class="sideMenuItem">
                <span class="sideMenuSpan" data-id="' . $sideMenuItens['id'] . '" data-content="' . $sideMenuItens['content'] . '">' . $sideMenuItens['menuItem'] . '</span>               
            </li>';
    }
    echo '</ul>';  // Fim da lista
}

?>


