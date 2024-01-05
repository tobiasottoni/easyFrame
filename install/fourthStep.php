<?php

$pathFileConfig = '../config/config.txt';
$dataFileConfig = 'Successful configuration on ' . date('Y-m-d H:i:s');

if (file_put_contents($pathFileConfig, $dataFileConfig)) {
    echo 'You have successfully configured your AZ Linked';
} else {
    echo 'Error creating configuration file.';
}

?>

<button  class='formButtons' onclick="acessarPainel()">Finish</button>

<script>
    function acessarPainel() {
        window.location.href = '../panel/index.php';
    }
</script>
