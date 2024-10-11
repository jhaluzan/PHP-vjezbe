<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
        $a = $_POST['vrijednost_a'];
        $b = $_POST['vrijednost_b'];
        $c = (3 * $a - $b) / 2;

        echo 'Vrijednost a: ' . $a . '<br>';
        echo 'Vrijednost b: ' . $b . '<br>';
        echo 'Vrijednost c = (3 * '. $a . '-' . $b . ') / 2 = ' . $c;
    ?>

</body>
</html>


