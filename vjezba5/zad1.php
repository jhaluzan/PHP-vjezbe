<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h3>Igra (pogodi broj)</h3>
    <form method="post">
        Upiši jedan broj od 1 do 10: <input type="broj" name="broj" min="1" max="9" required>
    </form>

    <?php
    $nasumicniBroj = rand(1, 9); // Generiramo broj između 1 i 9

    if (isset($_POST["broj"])) {
        $uneseniBroj = $_POST["broj"];
        
        if ($uneseniBroj == $nasumicniBroj) {
            echo '<h3 style="color:green;">Pogodak, probaj ponovno!</h3>';
        } else {
            echo '<h3 style="color:red;">Krivo, probaj ponovno!</h3>';
        }
        
        echo '<h3>Zamišljeni broj je: ' . $nasumicniBroj . '</h3>';
    }
    ?>
</body>
</html>