
<?php

$a = 4;
define('B', 10);
$c = 4.0;
$d = 5.667;

echo "Wynik dodawania a i B: " . ($a + B) . "\n";
echo "Wynik dzielenia a przez B: " . ($a / B) . "\n";
echo "Wynik a do potęgi B: " . pow($a, B) . "\n";
echo "Reszta z dzielenia B przez a: " . (B % $a) . "\n";
echo "Czy a ma taką samą wartość jak B: " . ($a == B ? 'Tak' : 'Nie') . "\n";
echo "Czy wartość a jest większa od B: " . ($a > B ? 'Tak' : 'Nie') . "\n";
echo "Czy wartość a jest większa od B (używając operatora trójargumentowego): " . ($a > B ? 'Tak' : 'Nie') . "\n";
echo "Czy a i c mają taką samą wartość: " . ($a == $c ? 'Tak' : 'Nie') . "\n";
echo "Czy a i c mają taką samą wartość (z uwzględnieniem typu): " . ($a === $c ? 'Tak' : 'Nie') . "\n";
echo "D bez części po przecinku: " . floor($d) . "\n";
echo "D zaokrąglone do 2 miejsc po przecinku: " . round($d, 2) . "\n";

?>


