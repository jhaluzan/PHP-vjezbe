<?php
$host = '127.0.0.1';
$user = 'root'; 
$password = ''; 
$dbname = 'test3';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Povezivanje na bazu nije uspjelo: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, country_code = ? WHERE id = ?");
    $stmt->bind_param("sssi", $_POST['first_name'], $_POST['last_name'], $_POST['country_code'], $_POST['user_id']);
    $stmt->execute();
    $stmt->close();
}

$sql_users = "
SELECT 
    u.id AS UserID,
    CONCAT(u.user_firstname, ' ', u.user_lastname) AS FullName,
    u.user_firstname,
    u.user_lastname,
    u.country_code,
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

$sql_countries = "SELECT country_code, country_name FROM countries ORDER BY country_name";

$result_users = $conn->query($sql_users);
$countries = $conn->query($sql_countries)->fetch_all(MYSQLI_ASSOC);

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
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_users->num_rows > 0) {
                while ($row = $result_users->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['FullName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Country'] ?? 'Nepoznata') . "</td>";
                    echo "<td>
                        <form method='post'>
                            <input type='hidden' name='user_id' value='" . $row['UserID'] . "'>
                            <input type='text' name='first_name' value='" . htmlspecialchars($row['user_firstname']) . "' required>
                            <input type='text' name='last_name' value='" . htmlspecialchars($row['user_lastname']) . "' required>
                            <select name='country_code'>";
                            foreach ($countries as $country) {
                                echo "<option value='" . $country['country_code'] . "' " . ($country['country_code'] === $row['country_code'] ? 'selected' : '') . ">" . htmlspecialchars($country['country_name']) . "</option>";
                            }
                    echo "</select>
                            <button type='submit'>Spremi</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nema podataka za prikaz.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>