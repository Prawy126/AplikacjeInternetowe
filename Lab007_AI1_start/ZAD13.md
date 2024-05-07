# 13. Spróbować usunąć pierwszy kraj. Wyjaśnić zaistniałą sytuację. Zaproponować rozwiązanie problemu.

Wykorzystać sposób wyświetlania błędów w sesji umieszczony w szablonie
resources\views\shared\session-error.blade.php.

Komunikat o błędzie wskazuje na naruszenie ograniczenia klucza obcego. Dzieje się tak, gdy próbuje się usunąć rekord, na który powołuje się inna tabela za pośrednictwem klucza obcego. W tej sytuacji wygląda na to, że w tabeli trips istnieją wycieczki, które odnoszą się do wpisu w tabeli countries, który próbujesz usunąć.

Aby rozwiązać ten problem, możesz:

Usunąć powiązane wiersze w tabeli trips przed próbą usunięcia kraju, ręcznie lub ustawiając kaskadowe usuwanie (CASCADE) w ograniczeniu klucza obcego bazy danych.

Jeśli logika biznesowa na to pozwala, zaimplementować miękkie usuwanie (soft delete) za pomocą cechy SoftDeletes w modelu Country. W ten sposób kraj nie zostanie faktycznie usunięty z bazy danych, a więc zachowana zostanie integralność tabeli trips, która się na niego odwołuje.
