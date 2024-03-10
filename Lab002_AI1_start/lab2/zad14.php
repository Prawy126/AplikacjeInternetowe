<?php
// Importowanie niezbędnych klas
require 'vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class Dog {
    private $id;

    // Konstruktor przyjmujący nazwę, wiek i datę przyjęcia psa
    public function __construct(private $name,private $age,private $admissionDate) {
        // Generowanie unikalnego identyfikatora v4
        $this->id = Uuid::uuid4()->toString();
    }

    // Metoda do wypisania informacji o psie
    public function printInfo() {
        echo "Dog ID: $this->id\n";
        echo "Name: $this->name\n";
        echo "Age: $this->age\n";
        echo "Admission Date: $this->admissionDate\n";
        echo "\n";
    }
}

// Tworzenie przykładowych psów
$dogs = [];
$dogs[] = new Dog("Burek", 3, "2023-10-15");
$dogs[] = new Dog("Azor", 5, "2022-08-20");
$dogs[] = new Dog("Rex", 2, "2024-01-05");
$dogs[] = new Dog("Luna", 4, "2021-12-01");
$dogs[] = new Dog("Milo", 1, "2023-05-10");

// Wyświetlanie informacji o psach
foreach ($dogs as $dog) {
    $dog->printInfo();
}
