<?php
session_start();

// Sprawdzenie czy żądanie zawiera token CSRF
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['csrf_token'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Request rejected. CSRF token mismatch."); // Odrzuć żądanie z błędem CSRF token mismatch
    }
}

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
    <title>Zad8</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <div id="inne" class="container mt-5 mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-8">
                <h2>Zapytania o ofertę</h2>
                <!-- Wygenerować tabelkę HTML zawierającą wcześniej pobrane dane -->
                <table class="table table-hover table-striped">
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
                        <tr>
                            <th scope="row"><?php print $r['id']?></th> 
                            <td><?php print $r['email']?></td>
                            <td><?php print $r['offer_type']?></td> 
                            <td><?php print $r['budget']?></td>
                            <td><?php print $r['comment']?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div> 
    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>
