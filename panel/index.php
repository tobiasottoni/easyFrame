<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../images/favicon.png" type="image/png" />

    <title>easyFrame Panel</title>


    <link href="../styles/panelModule.css" rel="stylesheet">
    <link href="../styles/footerModule.css" rel="stylesheet">
    <link href="../styles/ckEditor.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../thirdParty/fontawesome/css/font-awesome.min.css">


</head>

<header>

</header>

<body>

    <div class="bodyDiv">
        <div class="pageDiv">

            <div class="contentsDiv" id="contentsDiv">
                <div class="logoDiv">
                    <a href="index.php"><img class="logoHeader" src='../images/logo.png' /></a>
                </div>

                <div class="userDiv">

                    <?php
                    if (isset($_SESSION) and $_SESSION != null) {
                        echo '<div class="userBtns" id="btnExit"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</div>';
                    }
                    ?>

                </div>


                <div class="panelContent" id="panelContent">


                    <?php

                    if ($_SESSION["user_id"] == null) {
                        require_once('../login/loginForm.php');
                    }

                    if (isset($_SESSION["user_id"]) and $_SESSION["user_id"] != null) {

                        echo "<div class='sideMenuDiv'>

                        <nav class='sideMenuContainer' id='sideMenuContainer'>
                            <ul class='sideMenuList' id='sideMenuList'>
                                ";

                        require_once('sideMenu.php');

                        echo "</ul>
                        </nav>

                    </div>

                    <div class='contentsPanelDiv' id='contentsPanelDiv'>


                    </div>";
                    }

                    ?>






                </div>

            </div>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.sideMenuContainer').addEventListener('click', function(event) {
                if (event.target.classList.contains('sideMenuSpan')) {

                    var menuID = event.target.getAttribute('data-id');
                    var content = event.target.getAttribute('data-content');

                    console.log('Id Side clicado: ' + menuID);
                    console.log('content: ' + content);

                    $.ajax({
                        url: content,
                        type: 'GET',
                        success: function(data) {
                            $('#contentsPanelDiv').html(data);
                        },
                        error: function() {
                            alert('Erro ao carregar o conteúdo.');
                        }
                    });

                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btnExit = document.getElementById('btnExit');

            btnExit.addEventListener('click', function() {
                fetch('../logout/logout.php', {
                        method: 'POST',
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert('Please come back soon!');
                        window.location.href = '../panel/index.php';
                    })
                    .catch(error => {
                        console.error('Erro ao fazer logout:', error);
                    });
            });
        });
    </script>



</body>

<footer>

    <div className="footerDiv">

        <?php require_once('../components/footer.php'); ?>

    </div>

</footer>

</html>