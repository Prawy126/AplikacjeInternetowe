<?php
$fruits = ["banana", "apple", "strawberry", "grape", "orange", "watermelon", "blueberry"];

//Wyświetlenie owoców z pętlą foreach z { }
echo "\tpętla foreach  \n";
foreach($fruits as $fruit){
    echo $fruit. "\n";
}

echo "\tpętla foreach endforeach\n";
//Wyświetlenie owoców z pętlą foreach z endforeach

foreach($fruits as $fruit):
    echo $fruit . "\n";
endforeach

?>