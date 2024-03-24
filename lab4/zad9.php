<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ai1_lab4";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pobierz zawartość tabeli questions
    $sth = $conn->prepare("SELECT id, email, offer_type, budget, comment FROM questions");
    $sth->execute(); 
    $result = $sth->fetchAll(); 

} catch (PDOException $e) {
    echo "Fail: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="pl" data-bs-theme="">
  <head>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zad9</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <div id="inne" class="container mt-5 mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-8">
                <h2>Zapytania o ofertę</h2>
                
                <!-- Formularz filtrujący -->
                <form method="GET" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                </form>
                
                <!-- Tabelka z danymi -->
                <table class="table table-hover table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th> 
                            <th scope="col">Oferta</th> 
                            <th scope="col">Budget</th> 
                            <th scope="col">Komentarz</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $r): ?>
                            <?php if (isset($_GET['email']) && $_GET['email'] !== '' && $r['email'] !== $_GET['email']) continue; ?>
                            <tr>
                                <th scope="row"><?php echo $r['id'] ?></th> 
                                <td><?php echo $r['email'] ?></td>
                                <td><?php echo $r['offer_type'] ?></td> 
                                <td><?php echo $r['budget'] ?></td>
                                <td><?php echo $r['comment'] ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div> 
    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>
<php //
SQL Injection: Jest to najważniejszy negatywny aspekt. Jeśli aplikacja internetowa nie sprawdza i nie waliduje danych wejściowych, hakerzy mogą wykorzystać ten fakt do wstrzykiwania złośliwego kodu SQL. Mogą to zrobić, wpisując złośliwe zapytania SQL w polach formularzy, które są następnie bezpośrednio łączone z zapytaniami SQL w kodzie aplikacji. Jeśli hakerzy zdołają wstrzyknąć złośliwy kod SQL, mogą uzyskać dostęp do bazy danych, zmieniając, usuwając lub kopiując dane, a nawet naruszając bezpieczeństwo całej aplikacji.

Błąd składniowy: Bezpośrednie łączenie stringów może prowadzić do błędów składniowych, zwłaszcza gdy dane użytkownika zawierają znaki specjalne lub znaki formatowania. Jeśli dane te nie są poprawnie ucieczkowane lub zamieniane na bezpieczne znaczniki, mogą one powodować błędy w wykonywaniu zapytań SQL.

Nieoczekiwane wyniki: Bez odpowiedniego sanitarnego kodu mogą wystąpić nieoczekiwane wyniki zapytań SQL. Na przykład, gdy użytkownik wprowadzi znaki specjalne, takie jak pojedynczy cudzysłów, kod SQL może interpretować to jako koniec ciągu lub wstrzyknięcie kodu, co prowadzi do nieprawidłowych lub nieoczekiwanych wyników zapytania.

Bezpieczeństwo danych: Nieprawidłowe łączenie stringów może prowadzić do naruszenia bezpieczeństwa danych. Hakerzy mogą uzyskać dostęp do poufnych informacji lub mogą zmieniać, usuwać lub dodawać dane w bazie danych, co zagraża integralności i poufności danych.
// ?>