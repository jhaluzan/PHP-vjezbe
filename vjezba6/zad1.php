<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h2>Kalkulator (Switch naredba)</h2>

<form method="post" action="">
    <label for="broj1">Upiši prvi broj *</label>
    <input type="broj" name="broj1" id="broj1" required>
    <br> <br>
    <label for="broj2">Upiši drugi broj *</label>
    <input type="broj" name="broj2" id="broj2" required>
    <br> <br>
    <button type="submit" name="operator" value="+">+</button>
    <button type="submit" name="operator" value="-">-</button>
    <button type="submit" name="operator" value="*">*</button>
    <button type="submit" name="operator" value="/">/</button>
</form>

<?php
if (isset($_POST["broj1"]) && isset($_POST["broj2"])) {
    $broj1 = $_POST["broj1"];
    $broj2 = $_POST["broj2"];
    $operator = $_POST["operator"];
    $rezultat ='';

    switch ($operator) {
        case "+":
            $rezultat = $broj1 + $broj2;
            break;
        case "-":
            $rezultat = $broj1 - $broj2;
            break;
        case "*":
            $rezultat = $broj1 * $broj2;
            break;
        case "/":
            $rezultat = $broj1 / $broj2;
            break;
    }

    echo '<h3>Rezultat: ' . $rezultat . '</h3>';
}
?>

</body>
</html>