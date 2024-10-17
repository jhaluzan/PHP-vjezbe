<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h2>Izračun prosjeka i konačne ocjene</h2>

<form method="post" action="">
    <label for="ocjena1">Unesi ocjenu I. kolokvija (1-5):</label>
    <input type="number" name="ocjena1" id="ocjena1" required>

    <br>

    <label for="ocjena2">Unesi ocjenu II. kolokvija (1-5):</label>
    <input type="number" name="ocjena2" id="ocjena2" required>

    <br>

    <button type="submit">Izračunaj</button>
</form>

<?php
 if (isset($_POST['ocjena1']) && isset($_POST['ocjena2'])) {
    $ocjene = array($_POST['ocjena1'], $_POST['ocjena2']);

    if ($ocjene[0] < 1 || $ocjene[0] > 5 || $ocjene[1] < 1 || $ocjene[1] > 5 ) {
      echo 'Unesi ocjene od 1 do 5';
    } else if ($ocjene[0] == 1 || $ocjene[1] == 1 ) {
      print 'Ocjena je negativna jer je jedan od kolokvija negativan';
    } else {
      $prosjek = ($ocjene[0] + $ocjene[1]) / 2;
      echo '<p>Ocjena I kolokvija: '.$ocjene[0].'</p>';
      echo '<p>Ocjena II kolokvija: '.$ocjene[1].'</p>';
      echo '<p>Prosjek ocjena iz predmeta: '.$prosjek.'</p>';
      echo '<p>Konačna ocjena iz predmeta: '.round($prosjek).'</p>';
    }
}
?>

</body>
</html>