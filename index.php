<?php
session_start();
require_once('config/config_check.php');
include('connections/databaseConnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="public/images/favicon.png" type="image/png" />

    <title>Easy Frame Project - The evolution of framework</title>

    <link href="styles/pagesModule.css" rel="stylesheet">
    <link href="styles/cssAnimations.css" rel="stylesheet">
    <link href="styles/cssTables.css" rel="stylesheet">
    <link href="styles/footerModule.css" rel="stylesheet">
    <link href="styles/topMenu.css" rel="stylesheet">
    <link href="styles/menuDropdown.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="thirdParty/fontawesome/css/font-awesome.min.css">


</head>

<header>

<?php require_once('components/facebookPixel.php'); ?>
</header>

<?php require_once('components/googleAnalytics.php'); ?>

<body>
    <div class="bodyDiv">
        <div class="headerDiv">
            <div class="logoDiv">
                <a href="index.php"><img class="logoHeader" src='public/images/logo/logo.png' /></a>
            </div>

            <div class="socialDiv">
                <?php require_once('components/socialIcons.php') ?>
            </div>

            <div class="welcomeDiv">
                The evolution of Frameworks
            </div>

            <div class="userDiv">

                <p class="userContents">contact@easyframeproject.com</p>
              
            </div>

        </div>

        <nav class="topMenuContainer">
            <ul class="topMenuList">
                <?php require_once('components/menuDropdown.php'); ?>
            </ul>
        </nav>




        <div class="pageDiv">

            <div class="contentsDiv" id="contentsDiv">

                <div class="slider-container">
                    <?php require_once 'components/slides.php'; ?>
                </div>

                <div class="someContentDiv">

                    <nav class="someContentContainer" id="someContentContainer">
                        <ul class="someContentList" id="someContentList">
                            <?php require_once 'components/someContentHome.php'; ?>
                        </ul>
                    </nav>

                </div>

            </div>

        </div>

    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.topnav').addEventListener('click', function(event) {
                if (event.target.classList.contains('topNavSpan')) {
                    var parentSubMenu = event.target.getAttribute('data-id');

                    console.log('Id Side clicado: ' + parentSubMenu);

                    fetch('components/contents.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'parentSubMenu=' + encodeURIComponent(parentSubMenu)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erro na solicitação. Código do status: ' + response.status);
                            }
                            return response.text();
                        })
                        .then(data => {
                            var contentsDiv = document.getElementById('contentsDiv');
                            contentsDiv.innerHTML = data;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.someContentContainer').addEventListener('click', function(event) {
                if (event.target.classList.contains('someContentSpan')) {
                    var parentSubMenu = event.target.getAttribute('data-id');

                    fetch('components/contents.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'parentSubMenu=' + encodeURIComponent(parentSubMenu)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erro na solicitação. Código do status: ' + response.status);
                            }
                            return response.text();
                        })
                        .then(data => {
                            var contentsDiv = document.getElementById('contentsDiv');
                            contentsDiv.innerHTML = data;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            });
        });
    </script>

    <script src="scripts/menu.js"></script>


</body>

<footer>

    <div className="footerDiv">

        <?php require_once('components/footer.php'); ?>

    </div>

</footer>

</html>
