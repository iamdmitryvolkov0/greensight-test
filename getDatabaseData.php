<!DOCTYPE html>
<html>
<head>
    <title>Вывод данных из MySQL</title>
    <meta charset="utf-8"/>
</head>
<body>
<h2>Список пользователей</h2>
<?php
$connect = new mysqli("localhost", "root", "", "test");
if ($connect->connect_error) {
    die("Ошибка: " . $connect->connect_error);
}
$sql = 'SELECT id, firstName, secondName, email FROM users ORDER BY id';
if ($result = $connect->query($sql)) {
    $rowsCount = $result->num_rows; // количество полученных строк
    echo "<p>Получено объектов: $rowsCount</p>";
    echo "<table><tr><th>Id</th><th>Имя</th><th>Фамилия</th><th>email</th></tr>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["firstName"] . "</td>";
        echo "<td>" . $row["secondName"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Ошибка: " . $connect->error;
}
$connect->close();
?>
</body>
</html>