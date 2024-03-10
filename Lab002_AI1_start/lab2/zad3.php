<?php

// Tworzenie zmiennych a i B oraz przypisanie im wartości z poprzedniego zadania
$a = 5;
define('B', 10);

// Wyświetlenie wartości przed zmianą
echo "Wartość zmiennej a przed zmianą: $a \n";
echo "Wartość zmiennej B przed zmianą: ".B." \n";

// Przypisanie nowych wartości do zmiennych, wyświetla błąd po występuje próba przypisania do stałej B nowej wartości
$a = 7;
B = 22;

// Wyświetlenie nowych wartości
echo "Nowa wartość zmiennej a: $a \n";
echo "Nowa wartość zmiennej B: " .B." \n";

?>

