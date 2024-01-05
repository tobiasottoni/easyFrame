<?php
session_start();

if ($_SESSION["accessLevel"] != 1) {
    // Usuário não tem permissão, redirecionar ou exibir mensagem
    header("Location: index.php");
    exit();
}



include('../connections/databaseConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação e recuperação dos dados do formulário
    $parentSubMenu = mysqli_real_escape_string($conn, $_POST["parentSubMenu"]);

    // Obtenha o conteúdo do POST
    $content = $_POST["content"];

    // Substitua espaços por underline
    $content = str_replace(' ', '_', $content);

    // Converta para minúsculas
    $my_content = strtolower($content);

    $content = mysqli_real_escape_string($conn, $my_content);

    $pathFileConfig = '../pages/' . $my_content . '.php';
    $dataFileConfig = '<?php echo"New page of ' . $_POST["content"] . '"; ?>';

    $content_link = $pathFileConfig;

    if (file_put_contents($pathFileConfig, $dataFileConfig)) {


        // Utilização de declaração preparada para prevenir SQL injection
        $queryMenuItem = "INSERT INTO contents (parentSubMenu, content, createDate, active) VALUES ('" . $parentSubMenu . "','" . $content_link . "', NOW(), 'active')";
        $execMenuItem = mysqli_query($conn, $queryMenuItem);

        if ($execMenuItem) {

            echo '<script>
            alert("Content Registered Successfully!");
            window.location.href = "../panel/index.php";
    </script>';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo 'Error creating content file.';
    }
}
