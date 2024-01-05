<?php

// Verificar se o formulário de atualização foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_slide"])) {
    $slide_id = $_POST["slide_id"];
    $active = $_POST["active"];

    include('../connections/databaseConnection.php');

    // Atualizar status do slide no banco de dados
    $sqlUpdateSlide = "UPDATE slides SET active = ? WHERE id = ?";
    $stmt = $conn->prepare($sqlUpdateSlide);
    $stmt->bind_param("si", $active, $slide_id);

    if ($stmt->execute()) {
       echo '<script>
            alert("Successfully Deactivate!");
            window.location.href = "../panel/index.php";
            </script>';
    } else {
        echo "Erro ao atualizar o slide: " . $stmt->error;
    }

    $stmt->close();
}


?>

