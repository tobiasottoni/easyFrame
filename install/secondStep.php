<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $databaseName = $_POST["databaseName"];
    $dbUserName = $_POST["dbUserName"];
    $pass = $_POST["pass"];
    $dbServer = $_POST["dbServer"];


    $conn = new mysqli($dbServer, $dbUserName, $pass);

    if ($conn->connect_error) {
        die("Erro na conexão com o servidor de banco de dados: " . $conn->connect_error);
    }


    $sql = "CREATE DATABASE IF NOT EXISTS " . $databaseName;
    if ($conn->query($sql) === TRUE) {
        $connectionContent = '<?php' . PHP_EOL . PHP_EOL;
        $connectionContent .= '$server = "' . $dbServer . '";' . PHP_EOL;
        $connectionContent .= '$user = "' . $dbUserName . '";' . PHP_EOL;
        $connectionContent .= '$pass = "' . $pass . '";' . PHP_EOL;
        $connectionContent .= '$database = "' . $databaseName . '";' . PHP_EOL . PHP_EOL;
        $connectionContent .= '$conn = mysqli_connect(' . PHP_EOL;
        $connectionContent .= '    $server,' . PHP_EOL;
        $connectionContent .= '    $user,' . PHP_EOL;
        $connectionContent .= '    $pass,' . PHP_EOL;
        $connectionContent .= '    $database' . PHP_EOL;
        $connectionContent .= ');' . PHP_EOL . PHP_EOL;
        $connectionContent .= 'if (!$conn) {' . PHP_EOL;
        $connectionContent .= '    die("Connection Fail: " . mysqli_connect_error());' . PHP_EOL;
        $connectionContent .= '}' . PHP_EOL . PHP_EOL;
        $connectionContent .= '?>';

        file_put_contents('../connections/databaseConnection.php', $connectionContent);


        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => $conn->error));
    }

    $conn->close();
    exit();
}
?>

<script>
    function validateForm() {
        var databaseName = document.forms["form"]["databaseName"].value;
        var dbUserName = document.forms["form"]["dbUserName"].value;
        var pass = document.forms["form"]["pass"].value;
        var dbServer = document.forms["form"]["dbServer"].value;

        
        if (databaseName == "" || dbUserName == "" || dbServer == "") {
            alert("Por favor, preencha todos os campos.");
            return false;
        }

        if (databaseName.includes(" ") || dbUserName.includes(" ")) {
            alert("Os nomes do banco e do usuário não devem conter espaços.");
            return false;
        }

        return true;
    }


    $(document).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "secondStep.php",
                data: $("#form").serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        alert('Database created successfully!');
                        $.ajax({
                            url: 'thirdStep.php',
                            type: 'GET',
                            success: function(data) {
                                $('#installForm').html(data);
                            },
                            error: function() {
                                alert('Error loading the registration form.');
                            }
                        });
                    } else {
                        alert('Error creating the database: ' + response.error);
                    }
                },
                error: function() {
                    alert('Error in AJAX request.');
                }
            });
        });
    });
</script>

<h2>Second Step</h2>

<form id="form" name="form" action="" method="post" onsubmit="return validateForm()">
    <label class="formLabels" for="databaseName">Database Name:</label>
    <input class="formFields" type="text" id="databaseName" name="databaseName" required>

    <label class="formLabels" for="dbUserName">User Name:</label>
    <input class="formFields" type="text" id="dbUserName" name="dbUserName" required>

    <label class="formLabels" for="pass">Password:</label>
    <input class="formFields" type="password" id="pass" name="pass">

    <label class="formLabels" for="dbServer">Database Server:</label>
    <input class="formFields" type="text" id="dbServer" name="dbServer" required>

    <input class="formButtons" type="submit" value="Send">
</form>