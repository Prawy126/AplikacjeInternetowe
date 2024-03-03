<?php
// Ustawienie strefy czasowej na GMT+0 (czas uniwersalny)
date_default_timezone_set('GMT');

// Obecna data w formacie: Thursday, 04-03-2024
echo date('l, d-m-Y') . "\n";

// Obecna data i godzina w formacie: 2024-March-04 10:10
echo date('Y-F-d H:i') . "\n";

// Obliczenie liczby dni pomiędzy dniem dzisiejszym a 12 marca 2021 roku
$currentDate = new DateTime();
$targetDate = new DateTime('2021-03-12');
$interval = $currentDate->diff($targetDate);
echo "Liczba dni pomiędzy dniem dzisiejszym a 12 marca 2021 roku: " . $interval->days . " dni\n";

// Obliczenie liczby godzin i minut pomiędzy aktualną godziną a 7:00 dnia dzisiejszego
$currentTime = new DateTime();
$targetTime = new DateTime('07:00');
$interval = $currentTime->diff($targetTime);
echo "Liczba godzin i minut pomiędzy aktualną godziną a 7:00 dnia dzisiejszego: " . $interval->h . " godzin " . $interval->i . " minut\n";

// Sprawdzenie, która data jest wcześniejsza: data dzisiejsza czy 1 kwietnia 2023 roku
$today = new DateTime();
$futureDate = new DateTime('2023-04-01');
if ($today < $futureDate) {
    echo "Data dzisiejsza jest wcześniejsza niż 1 kwietnia 2023 roku.\n";
} elseif ($today > $futureDate) {
    echo "1 kwietnia 2023 roku jest wcześniejsza niż data dzisiejsza.\n";
} else {
    echo "Data dzisiejsza i 1 kwietnia 2023 roku są takie same.\n";
}

