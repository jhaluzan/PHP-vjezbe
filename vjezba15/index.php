<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Pretraži korisnike</h1>
    <form method="POST" action="">
        <label for="search">Unesite ime ili prezime:</label><br>
        <input type="text" id="search" name="search">
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $con = mysqli_connect("localhost", "root", "123", "my_db");

        if (!$con) {
            die("Povezivanje na bazu nije uspjelo: " . mysqli_connect_error());
        }

        $unos = mysqli_real_escape_string($con, $_POST['search']);
        $query = "SELECT firstname, lastname FROM users WHERE firstname LIKE '%$unos%' OR lastname LIKE '%$unos%'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Rezultati pretrage:</h2><ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nema rezultata za traženi pojam.</p>";
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>