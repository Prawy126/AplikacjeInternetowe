<?php
class Point {
    

    // Konstruktor przyjmujący współrzędne x i y
    public function __construct(private $x, private $y) {}

    // Metoda do wypisania informacji o punkcie
    public function printInfo() {
        echo "Point($this->x, $this->y)\n";
    }

    // Metoda do aktualizacji współrzędnej x
    public function updateX($x) {
        $this->x = $x;
    }

    // Metoda do aktualizacji współrzędnej y
    public function updateY($y) {
        $this->y = $y;
    }

    // Metoda do przesunięcia punktu o podany dystans
    public function move($dx, $dy) {
        $this->x += $dx;
        $this->y += $dy;
    }
}

// Tworzenie przykładowych punktów i testowanie działania klasy
$point1 = new Point(2, 3);
$point2 = new Point(-1, 5);

// Wypisanie informacji o punktach
echo "Informacje o punktach:\n";
$point1->printInfo();
$point2->printInfo();

// Aktualizacja współrzędnych punktu 1
$point1->updateX(4);
$point1->updateY(6);

// Wypisanie zaktualizowanych informacji o punkcie 1
echo "Zaktualizowane informacje o punkcie 1:\n";
$point1->printInfo();

// Przesunięcie punktu 2 o podany dystans
$point2->move(3, -2);

// Wypisanie przesuniętej informacji o punkcie 2
echo "Przesunięte informacje o punkcie 2:\n";
$point2->printInfo();


