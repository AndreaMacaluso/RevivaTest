<?php
require_once realpath("vendor/autoload.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$input1="2 book at 12.49
1 music CD at 14.99
1 chocolate bar at 0.85";

$input2="1 imported box of chocolates at 10.00
1 imported bottle of perfume at 47.50";

$input3="1 imported bottle of perfume at 27.99
1 bottle of perfume at 18.99
1 packet of headache pills at 9.75
3 box of imported chocolates at 11.25";

echo '<br/><br/>';
$recepitTot1= new \App\ReceiptToT($input1);
$recepitTot1-> receiptToTShow ();
echo '<br/><br/>';
$recepitTot2= new \App\ReceiptToT($input2);
$recepitTot2-> receiptToTShow ();
echo '<br/><br/>';
$recepitTot3= new \App\ReceiptToT($input3);
$recepitTot3-> receiptToTShow ();
echo '<br/><br/>';
?>
</body>
</html>