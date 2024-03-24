<?php
print_r($_REQUEST);
print('<br>');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $offer_type = $_POST['offer_type'];
  $budget = isset($_POST['budget']) ? $_POST['budget'] : null;
  $comment = isset($_POST['comment']) ? $_POST['comment'] : null;

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ai1_lab4";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully. <br>";

    if ($budget !== null && $comment !== null) { // Check if budget and comment are set
      $sql = "INSERT INTO questions (email, offer_type, budget, comment) VALUES (?,?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$email, $offer_type, $budget, $comment]);
      echo "New record created successfully. <br>";
    } else {
      echo "Budget and comment are required. <br>";
    }

    $conn = null;
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    echo $sql . "<br>" . $e->getMessage();
    $conn = null;
  }
} else {
    echo "Method not supported. <br>";
}
