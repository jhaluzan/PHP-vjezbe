<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Zadatak str_word_count</h1>
    <p>U zadatku se traži da se ispiše koliko je riječi u rečenici. Koristite naredbu <code>str_word_count</code>.</p>
    
    <form method="post">
        <label for="inputText">Ulazni niz:</label>
        <input type="text" id="inputText" name="inputText">
        <button type="submit">Ispiši broj riječi</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputText = $_POST["inputText"];
        $wordCount = str_word_count($inputText);
        
        echo "<p>Ulazni niz: $inputText</p>";
        echo "<p>Broj riječi u rečenici: $wordCount</p>";
    }
    ?>
</body>
</html>