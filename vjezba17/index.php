<?php
$host = '127.0.0.1';
$user = 'root'; 
$password = ''; 
$dbname = 'test3';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Povezivanje na bazu nije uspjelo: " . $conn->connect_error);
}

$sql = "
SELECT 
    u.id AS UserID,
    CONCAT(u.user_firstname, ' ', u.user_lastname) AS FullName,
    c.country_name AS Country
FROM 
    users u
LEFT JOIN 
    countries c
ON 
    u.country_code = c.country_code
ORDER BY 
    c.country_name, u.user_lastname, u.user_firstname;
";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popis</title>
</head>
<body>
    <h1>Popis</h1>
    <table>
        <thead>
            <tr>
                <th>ID Korisnika</th>
                <th>Ime i Prezime</th>
                <th>Država</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['FullName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Country'] ?? 'Nepoznata') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nema podataka za prikaz.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>