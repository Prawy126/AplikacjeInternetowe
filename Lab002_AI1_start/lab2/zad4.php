<?php

$text1 = " Programuję dobrze ";
$text2 = "dobrze w PHP. ";

// Długość zmiennej text1
echo "Długość zmiennej text1: " . strlen($text1) . "\n";

// Zmienna text2 w odwrotnej kolejności
echo "Zmienna text2 w odwrotnej kolejności: " . strrev($text2) . "\n";

// Która zmienna zawiera dłuższy ciąg znaków?
if (strlen($text1) > strlen($text2)) {
    echo "Zmienna text1 zawiera dłuższy ciąg znaków.\n";
} elseif (strlen($text1) < strlen($text2)) {
    echo "Zmienna text2 zawiera dłuższy ciąg znaków.\n";
} else {
    echo "Obie zmienne mają równą długość ciągu znaków.\n";
}

// Czy zmienna text1 zawiera słowo Programuję?
if (strpos($text1, "Programuję") !== false) {
    echo "Zmienna text1 zawiera słowo 'Programuję'.\n";
} else {
    echo "Zmienna text1 nie zawiera słowa 'Programuję'.\n";
}

// Czy zmienna text2 zaczyna się słowem dobrze?
if (strpos($text2, "dobrze") === 0) {
    echo "Zmienna text2 zaczyna się od słowa 'dobrze'.\n";
} else {
    echo "Zmienna text2 nie zaczyna się od słowa 'dobrze'.\n";
}

// Połączone zmienne text1 oraz text2 z wcześniej usuniętymi nadmiarowymi spacjami
$text3 = trim($text1) . " " . trim($text2);
echo "Połączone zmienne text1 oraz text2 bez nadmiarowych spacji: $text3\n";

// Rezultat z powyższej pauzy umieścić w zmiennej text3 podzielić według separatora będącym spacją
$words = explode(" ", $text3);
echo "Tablica powstała po podziale zmiennych text1 oraz text2 według spacji:\n";
print_r($words);

// Zmienna text1 ze zmienionym słowem dobrze na źle
$text1_changed = str_replace("dobrze", "źle", $text1);
echo "Zmienna text1 ze zmienionym słowem 'dobrze' na 'źle': $text1_changed\n";

// Na którym indeksie (pozycji) zaczyna się słowo PHP w text2?
$php_index = strpos($text2, "PHP");
if ($php_index !== false) {
    echo "Słowo 'PHP' zaczyna się na indeksie $php_index w zmiennej text2.\n";
} else {
    echo "Słowo 'PHP' nie występuje w zmiennej text2.\n";
}

// Zmienna text1 z wszystkimi literami zmienionymi na duże
$text1_upper = strtoupper($text1);
echo "Zmienna text1 z wszystkimi literami zmienionymi na duże: $text1_upper\n";

// Zmienna text2 z pierwszą literą zmienioną na dużą
$text2_ucfirst = ucfirst($text2);
echo "Zmienna text2 z pierwszą literą zmienioną na dużą: $text2_ucfirst\n";

// Zmienna text2 w zakresie od 9 do 11 pozycji włącznie
$text2_substring = substr($text2, 8, 4);
echo "Zmienna text2 w zakresie od 9 do 11 pozycji włącznie: $text2_substring\n";
?>
