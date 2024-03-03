<?php
function division(int $x, int $y) {
    // Sprawdzenie czy drugi parametr nie jest równy 0
    if ($y === 0) {
        throw new Exception("Dzielenie przez zero jest niedozwolone.");
    }
    
    // Sprawdzenie czy oba parametry są liczbami całkowitymi
    if (!is_int($x) || !is_int($y)) {
        throw new Exception("Oba parametry muszą być liczbami całkowitymi.");
    }
    
    return $x / $y;
}

// Przetestowanie funkcji dla różnych zestawów parametrów
try {
    echo "Wynik dzielenia: " . division(10, 2) . "\n";
    echo "Wynik dzielenia: " . division(20, 5) . "\n";
    echo "Wynik dzielenia: " . division(8, 0) . "\n"; // Powinno zgłosić wyjątek
    echo "Wynik dzielenia: " . division(10, "abc") . "\n"; // Powinno zgłosić wyjątek
} catch (Exception $e) {
    echo "Błąd: " . $e->getMessage() . "\n";
}

