<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<body>
    <h1>Prosti brojevi</h1>

    <form method="post">
        <label for="broj">Unesite broj:</label>
        <input type="broj" id="broj" name="broj" required>
        <button type="submit">Provjeri</button>
    </form>

    <?php
    function prosti($broj) {
        if ($broj <= 1) {
            return false;
        }
        for ($i = 2; $i <= sqrt($broj); $i++) {
            if ($broj % $i == 0) {
                return false;
            }
        }
        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $broj = $_POST["broj"];

        if (prosti($broj)) {
            echo "<p>Broj $broj je prost.</p>";
        } else {
            echo "<p>Broj $broj nije prost.</p>";
        }
    }

    echo "<h2>Prosti brojevi manji od 100:</h2><p>";
    for ($i = 2; $i < 100; $i++) {
        if (prosti($i)) {
            echo $i . " ";
        }
    }
    echo "</p>";
    ?>
</body>
</html>