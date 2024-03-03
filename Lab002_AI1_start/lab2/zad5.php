<?php
//Zad 2.5

$n = 3.5;
$note;
// Ustawienie zmiennej n
$n = 3.5;
// Ustawienie zmiennej note na pusty ciąg znaków
$note = "";

// Używanie konstrukcji switch
switch ($n) {
    case 2.0:
        $note = "Niedostateczny";
        break;
    case 3.0:
        $note = "Dostateczny";
        break;
    case 3.5:
        $note = "Dostateczny plus";
        break;
    case 4.0:
        $note = "Dobry";
        break;
    case 4.5:
        $note = "Bardzo dobry";
        break;
    case 5.0:
        $note = "Celujący";
        break;
    default:
        $note = "";
}

echo "Za pomocą switch: $note\n";

// Używanie konstrukcji match (PHP 8.0+)
$note = match ($n) {
    2.0 => "Niedostateczny",
    3.0 => "Dostateczny",
    3.5 => "Dostateczny plus",
    4.0 => "Dobry",
    4.5 => "Bardzo dobry",
    5.0 => "Celujący",
    default => ""
};

echo "Za pomocą match: $note\n";

