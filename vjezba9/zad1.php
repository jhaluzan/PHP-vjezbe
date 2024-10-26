<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
function ducan($stanje = "Otvoren") {
    echo "Dućan je $stanje";
    echo "<br>";

    $trenutnoVrijeme = new DateTime();
    $trenutniDan = $trenutnoVrijeme->format('l');
    $trenutniSat = $trenutnoVrijeme->format('H');

    if ($trenutniDan == "Sunday") {
        $stanje = "Zatvoren";
    } elseif ($trenutniDan == "Saturday") {
        if ($trenutniSat >= 9 && $trenutniSat < 14) {
            $stanje = "Otvoren";
        } else {
            $stanje = "Zatvoren";
        }
    } else {
        if ($trenutniSat >= 8 && $trenutniSat < 20) {
            $stanje = "Otvoren";
        } else {
            $stanje = "Zatvoren";
        }
    }
    echo "Dućan je $stanje";
}
ducan();
?>

</body>
</html>