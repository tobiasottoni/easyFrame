<?php
$filename = 'config/config.txt';

if (file_exists($filename)) {
} else {

    header('Location: ../install/install.php');
}

?>
