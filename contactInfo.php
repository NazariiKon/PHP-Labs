<?php

class ContactInformation {
    public $name;
    public $email;
    public $phoneNumber;
    public $message;

    // Конструктор класу
    public function __construct($name, $email, $phoneNumber, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $message = $_POST["message"];

    // Перевірка, чи всі поля заповнені
    if (!empty($name) && !empty($email) && !empty($phoneNumber) && !empty($message)) {
        // Створення об'єкту ContactInformation з отриманими даними
        $contactInfo = new ContactInformation($name, $email, $phoneNumber, $message);
        saveContactToDatabase($contactInfo);

    } else {
        echo "Please fill in all the fields.";
    }
}

function saveContactToDatabase(ContactInformation $contactInformation) {
    // Підключення до бази даних SQLite
    $db = new SQLite3('my_database.db');

    // Перевірка наявності підключення до бази даних
    if (!$db) {
        echo "Помилка підключення до бази даних!";
        return;
    }

    // Підготовка SQL-запиту для вставки даних
    $sql = "INSERT INTO contacts (name, email, phoneNumber, message) VALUES (:name, :email, :phoneNumber, :message)";

    // Підготовка SQL-запиту
    $stmt = $db->prepare($sql);


    // Прив'язка параметрів до значень
    $stmt->bindParam(':name', $contactInformation->name);
    $stmt->bindParam(':email', $contactInformation->email);
    $stmt->bindParam(':phoneNumber', $contactInformation->phoneNumber);
    $stmt->bindParam(':message', $contactInformation->message);

    // Перевірка наявності підготовленого запиту
    if (!$stmt) {
        echo "Помилка підготовки SQL-запиту!";
        return;
    }

    // Виконання SQL-запиту
    $result = $stmt->execute();

    // Перевірка результату виконання SQL-запиту
    if ($result) {
        echo "Дані успішно збережені в базі даних!";
    } else {
        echo "Помилка при збереженні даних в базу даних!";
    }

    // Закриття підготовленого запиту і з'єднання з базою даних
    $stmt->close();
    $db->close();
}
?>
