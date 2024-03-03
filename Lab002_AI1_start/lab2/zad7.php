<?php
function rd(&$l) {
    $l = rand(1, 50);
}

// Przykładowe użycie funkcji
$l = 10;
echo "Wartość przed wywołaniem funkcji rd: $l\n";

rd($l); // Wywołanie funkcji rd zmienia wartość zmiennej $l

echo "Wartość po wywołaniu funkcji rd: $l\n";

