<?php
include('db_connection.php'); // Pretpostavljamo da datoteka db_connection.php postavlja $conn

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $drzava = $_POST['drzava'];
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    // Validacija korisničkog imena i lozinke
    if (strlen($korisnicko_ime) < 5 || strlen($korisnicko_ime) > 10) {
        $_SESSION['message'] = "Korisničko ime mora imati između 5 i 10 znakova.";
        header("Location: registracija.php");
        exit();
    }

    if (strlen($lozinka) < 4) {
        $_SESSION['message'] = "Lozinka mora imati najmanje 4 znaka.";
        header("Location: registracija.php");
        exit();
    }

    // Hashiranje lozinke
    $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT);

    // Provjera da li korisničko ime već postoji
    $check_username = "SELECT * FROM korisnici WHERE korisnicko_ime = '$korisnicko_ime'";
    $result = mysqli_query($conn, $check_username);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Korisničko ime već postoji. Molimo odaberite drugo.";
        header("Location: registracija.php");
        exit();
    }

    // SQL upit za unos korisnika
    $query = "INSERT INTO korisnici (ime, prezime, email, drzava, korisnicko_ime, lozinka)
              VALUES ('$ime', '$prezime', '$email', '$drzava', '$korisnicko_ime', '$hashed_password')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Registracija uspješna! Možete se prijaviti.";
        header("Location: index.php?menu=6");
        exit();
    } else {
        $_SESSION['message'] = "Greška pri registraciji: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Registracija</h1>
        <form method="POST" action="" class="form">
            <label for="ime">Ime:</label>
            <input type="text" name="ime" id="ime" required>
            <br><br>
            <label for="prezime">Prezime:</label>
            <input type="text" name="prezime" id="prezime" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br><br>
            <label for="drzava">Država:</label>
            <select name="drzava" id="drzava" required>
                <?php
                $drzave_query = "SELECT * FROM drzave";
                $drzave_result = mysqli_query($conn, $drzave_query);
                while ($row = mysqli_fetch_assoc($drzave_result)) {
                    echo "<option value='{$row['country_code']}'>{$row['country_name']}</option>";
                }
                ?>
            </select>
            <br><br>
            <label for="korisnicko_ime">Korisničko ime:</label>
            <input type="text" name="korisnicko_ime" id="korisnicko_ime" required>
            <small>(Korisničko ime mora imati između 5 i 10 znakova.)</small>
            <br><br>
            <label for="lozinka">Lozinka:</label>
            <input type="password" name="lozinka" id="lozinka" required>
            <small>(Lozinka mora imati najmanje 4 znaka.)</small>
            <br><br>
            <button type="submit">Registriraj se</button>
        </form>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='message'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>
    </div>
</body>
</html>