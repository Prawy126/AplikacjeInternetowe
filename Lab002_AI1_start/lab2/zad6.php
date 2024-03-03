<?php
function ctf(float $c = null) {
    if ($c === null) {
        echo "Nie podano wartości\n";
        return null;
    } else {
        $fahrenheit = ($c * 9/5) + 32;
        return $fahrenheit;
    }
}

// Przykładowe użycie funkcji
$result1 = ctf(); // Wyświetli komunikat "Nie podano wartości" i zwróci null
echo "Wynik: $result1\n";

$result2 = ctf(25); // Przeliczy 25 stopni Celsjusza na Fahrenheita
echo "Wynik: $result2\n";
