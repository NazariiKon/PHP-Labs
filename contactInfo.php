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

    } else {
        echo "Please fill in all the fields.";
    }
}

?>
