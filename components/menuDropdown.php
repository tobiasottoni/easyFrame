<div class="topnav" id="myTopnav">

  <?php

  $queryMenuTop = "SELECT * FROM menus WHERE active = 'active' ORDER BY id ASC";
  $doQueryMenuTop = mysqli_query($conn, $queryMenuTop);

  if ($doQueryMenuTop) {
    // Processar os resultados
    while ($topMenuItens = mysqli_fetch_assoc($doQueryMenuTop)) {


      echo '<div class="dropdown">
      <button class="dropbtn">' . $topMenuItens['menuItem'] . '
        <i class="fa fa-caret-down"></i>
      </button>';

      echo '<div class="dropdown-content">';

      $idTopMenu = $topMenuItens['id'];

      $queryMenuSide = "SELECT * FROM side_menus WHERE parentMenu=" . $idTopMenu . " AND active = 'active'";
      $doQueryMenuSide = mysqli_query($conn, $queryMenuSide);

      if ($doQueryMenuSide) {
        while ($sideMenuItens = mysqli_fetch_assoc($doQueryMenuSide)) {

          echo '<a class="topNavSpan" data-id="' . $sideMenuItens['id'] . '">' . $sideMenuItens['menuItem'] . '</a>';
        }
      } else {

        echo '</div></div>';
      }

      echo '</div></div>';
    }
  }

  ?>
</div>

<a href="javascript:void(0);" class="icon" id="topnavIcon" onclick="myFunction()">&#9776;</a>
</div>