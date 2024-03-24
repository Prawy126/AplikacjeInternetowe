<?php
$fruits = ["banana", "apple", "strawberry", "grape", "orange", "watermelon", "blueberry"];
?>
 
<!doctype html>
<html lang="en">
  <head>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zad3</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
	<div class="container">
    <ol>
		<?php foreach($fruits as $fruit):?>
      <li><?php echo $fruit ?></li>
    <?php endforeach;?>
  </ol>    
    </div>
    <script src="js/bootstrap.bundle.js"></script>
  </body>
</html>
