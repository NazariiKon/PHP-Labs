<?php

// Клас будинків
class House {
    public $price;
    public $name;
    public $address;
    public $contactPhone;
    public $image;
    public $bedrooms;
    public $bathrooms;

    // Конструктор класу
    public function __construct($price, $name, $address, $contactPhone, $image, $bedrooms, $bathrooms) {
        $this->price = $price;
        $this->name = $name;
        $this->address = $address;
        $this->contactPhone = $contactPhone;
        $this->image = $image;
        $this->bedrooms = $bedrooms;
        $this->bathrooms = $bathrooms;
    }

    // Метод для виведення інформації про будинок
    public function displayHouseInfo() {
        echo "<div class='house'>";
        echo "<h2>{$this->name}</h2>";
        echo "<p>Price: {$this->price}</p>";
        echo "<p>Address: {$this->address}</p>";
        echo "<p>Contact Phone: {$this->contactPhone}</p>";
        echo "<p>Bedrooms: {$this->bedrooms}</p>";
        echo "<p>Bathrooms: {$this->bathrooms}</p>";
        echo "<img src='{$this->image}' alt='{$this->name}' />";
        echo "</div>";
    }
    
    
}
// Функція для визначення акційної ціни
function calculateDiscount() {
    $discountPercent = rand(0, 30); // Випадковий % знижки від 0 до 30
    $isDiscounted = rand(0, 1); // Випадкове визначення, чи попадає будинок під акцію (0 - ні, 1 - так)

    return array($isDiscounted, $discountPercent);
}

// Створення об'єктів будинків
$house1 = new House(200000, "Cozy Cottage", "123 Main St", "555-1234", "cottage.jpg", 2, 1);
$house2 = new House(300000, "Modern Mansion", "456 Park Ave", "555-5678", "mansion.jpg", 5, 4);
$house3 = new House(150000, "Rustic Retreat", "789 Elm St", "555-9012", "retreat.jpg", 3, 2);

// // Виведення об'єктів будинків у секцію
// echo "<section>";
// $house1->displayHouseInfo();
// $house2->displayHouseInfo();
// $house3->displayHouseInfo();
// echo "</section>";

// Виведення об'єктів будинків у секцію
echo "<section>";
$houses = [$house1, $house2, $house3];
foreach ($houses as $house) {
    $discountInfo = calculateDiscount(); // Отримання інформації про знижку
    $isDiscounted = $discountInfo[0];
    $discountPercent = $discountInfo[1];

    // Виведення інформації про будинок
    $house->displayHouseInfo();

    // Якщо попадає під акцію, виведемо акційну ціну
    if ($isDiscounted) {
        $discountedPrice = $house->price * (1 - $discountPercent / 100); // Обчислення акційної ціни
        echo "<p style='color: red; font-size: larger; text-decoration: line-through;'>Discounted Price: $discountedPrice</p>";
    }
}
echo "</section>";
?>


