<h2>Contact Form</h2>

<form class="form" action="../components/process_form.php" method="post">
    <label class="formLabels" for="name">Name:</label>
    <input class="formFields" type="text" id="name" name="name" required><br>

    <label class="formLabels" for="email">Email:</label>
    <input class="formFields" type="email" id="email" name="email" required><br>

    <label class="formLabels" for="message">Message:</label><br>
    <textarea class="formFields" id="message" name="message" rows="4" required></textarea><br>

    <input class="formButtons" type="submit" value="Send">
</form>