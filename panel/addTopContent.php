<?php
session_start();

if ($_SESSION["accessLevel"] != 1) {
    // Usuário não tem permissão, redirecionar ou exibir mensagem
    header("Location: index.php");
    exit();
}

?>

<h2>Add Top Content</h2>
<form class="form" action="addTopContentProcess.php" method="post">

<label class="formLabels" for="email">Item</label>
    <input class="formFields" type="text" name="menuItem" required>
    <input class="formButtons" type="submit" value="Create Content">
</form>