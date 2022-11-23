<?php
require_once "validation.php";

if (!validate()) {
    exit('Поля не заполнены');
}


$query = "INSERT INTO users VALUES(NULL,:firstName,:secondName,:email,:password,:passwordCheck)";
$data = getPostData();
// Если всё ок со вставкой то редирект
if (insert($query, $data)) {
    header("Location:welcome.html");
} else {
    // тут лучше всего ошибку как-то выводить
    exit('Error while inserting data to database');
}

// Получаем отдельно данные из запроса
function getPostData(): array
{
    return [
        'firstName' => $_POST['firstName'],
        'secondName' => $_POST['secondName'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'passwordCheck' => $_POST['passwordCheck'],
    ];
}

// Делаем вставку в базу данных
function insert(string $query, array $fields): bool
{
    $database = connectDatabase();

    // Ошибка в запросе - отдельный лог
    try {
        $msg = $database->prepare($query);
        $msg->execute($fields);
    } catch (PDOException $e) {
        echo "Error query. " . $e->getMessage();
        return false;
    }

    return true;
}

// Получаем отдельно подключение к базе
function connectDatabase(): PDO
{
    // Если ошибка в подключении - отдельный лог
    try {
        $connectionDatabase = new PDO("mysql:host=localhost;dbname=test", 'root', '');
    } catch (PDOException $e) {
        echo "Error connecting to Database. " . $e->getMessage();
        return new PDO();
    }

    return $connectionDatabase;
}