<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h2>Označi vozilo:</h2>

<form method="post" action="">
    <?php
    $cars = array("Audi", "BMW", "Renault", "Citroen");
    foreach ($cars as $car) {
        echo '<input type="radio" name="car" value="'.$car.'" required> '.$car.'<br>';
    }
    ?>
    <br>
    <button type="submit">POŠALJI</button>
</form>

<?php
if (isset($_POST['car'])) {
    echo "<p>Odabrano vozilo: " . $_POST['car'] . "</p>";
}
?>

</body>
</html>
