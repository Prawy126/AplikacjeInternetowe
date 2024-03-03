<?php
// Utworzenie tablicy people
$people = array(
    "Anna" => 35,
    "Bartosz" => 42,
    "Piotr" => 29
);

// Wyświetlenie wszystkich elementów w tablicy, każdy w osobnej linijce
echo "Elementy tablicy:\n";
foreach ($people as $name => $age) {
    echo "$name ma $age lat\n";
}

// Wyświetlenie liczby elementów w tablicy
echo "Liczba elementów w tablicy: " . count($people) . "\n";

// Wyświetlenie wieku pana Bartosza
echo "Wiek pana Bartosza: " . $people["Bartosz"] . " lat\n";

// Dodanie pana Witolda mającego 28 lat
$people["Witold"] = 28;

// Usunięcie pana Piotra
unset($people["Piotr"]);

// Wyświetlenie tablicy posortowanej malejąco według wieku osób
arsort($people);
echo "Tablica posortowana malejąco według wieku osób:\n";
foreach ($people as $name => $age) {
    echo "$name ma $age lat\n";
}

