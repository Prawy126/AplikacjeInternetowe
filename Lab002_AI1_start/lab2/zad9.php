<?php
// Utworzenie tablicy owoców
$fruits = array("jabłko", "banan", "pomarańcza", "winogrono");

// Wyświetlenie liczby elementów w tablicy
echo "Liczba elementów w tablicy: " . count($fruits) . "\n";

// Wyświetlenie wszystkich elementów w tablicy, każdy w osobnej linijce
echo "Elementy tablicy:\n";
foreach ($fruits as $fruit) {
    echo $fruit . "\n";
}

// Dodanie cytryny na koniec listy
$fruits[] = "cytryna";

// Usunięcie ostatniego elementu listy
array_pop($fruits);

// Wyświetlenie tablicy posortowanej malejąco
rsort($fruits);
echo "Tablica posortowana malejąco:\n";
foreach ($fruits as $fruit) {
    echo $fruit . "\n";
}

