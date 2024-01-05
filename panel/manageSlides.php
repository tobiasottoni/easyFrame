<h2>Add New Slide</h2>

<p>*** Recomended slide size is 1280 x 540px</p>

<form action="uploadSlide.php" method="post" enctype="multipart/form-data">
    <label for="image">Image:</label>
    <input type="file" name="image" id="image" accept="image/*" required>

    <label for="alt">Alt Text:</label>
    <input type="text" name="alt" id="alt" required>

    <label for="link">Link:</label>
    <input type="text" name="link" id="link" required>

    <input type="submit" value="Adicionar Slide">
</form>


<?php
include('../connections/databaseConnection.php');


// Listar slides disponíveis
$sqlListSlides = "SELECT * FROM slides WHERE active = 'active'";
$result = $conn->query($sqlListSlides);

if ($result->num_rows > 0) {
    echo "<h2>Active Slides</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<img src='" . $row["src"] . "' alt='" . $row["alt"] . "' width='200' height='100'>";
        echo "<p>Link: " . $row["link"] . "</p>";

        // Adicionar formulário para desativar slide
        echo "<form action='deactivateSlide.php' method='post'>";
        echo "<input type='hidden' name='slide_id' value='" . $row["id"] . "'>";
        echo "<input type='hidden' name='active' value='" . ($row["active"] == 'active' ? 'inactive' : 'active') . "'>";
        echo "<input type='submit' name='update_slide' value='Desativar/Ativar Slide'>";
        echo "</form><br>";

        echo "</div>";
    }
} else {
    echo "<p>No slides available.</p>";
}

$conn->close();
?>
