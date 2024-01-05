    <h2>User Register</h2>
    <form class="form" action="register/registerProcess.php" method="post">
        <label class="formLabels" for="username">Name</label>
        <input class="formFields" type="text" name="username" required><br>

        <label class="formLabels" for="userPassword">Password</label>
        <input class="formFields" type="password" name="password" required><br>

        <label class="formLabels" for="email">E-mail</label>
        <input class="formFields" type="email" name="email" required><br>
       
        <input class="formButtons" type="submit" value="Cadastrar">
    </form>
