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

    <title>easyFrame Install</title>

    <link href="../styles/installModule.css" rel="stylesheet">
    <link href="../styles/footerModule.css" rel="stylesheet">
    <link href="../styles/ckEditor.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/super-build/ckeditor.js"></script>
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

                <div class="installContent">

                    <div class="installForm" id="installForm">

                        <?php

                        if ($_SESSION['installStep'] == null) {
                            require_once('firstStep.php');
                        }

                        ?>

                    </div>



                </div>

            </div>

        </div>

    </div>


    <script>
        $(document).ready(function() {
            $('#btnFirstStep').click(function() {
                $.ajax({
                    url: 'secondStep.php',
                    type: 'GET',
                    success: function(data) {
                        $('#installForm').html(data);
                    },
                    error: function() {
                        alert('Erro ao carregar o formulário de registro.');
                    }
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