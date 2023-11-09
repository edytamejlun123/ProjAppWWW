<?php
 $nr_indeksu = '167363';
 $nrGrupy = '3';
 echo 'Edyta Mejlun'.$nr_indeksu.' grupa '.$nrGrupy.'<br /><br />';
 echo 'Zastosowanie metody include <br />';
 echo "\n";

 echo "test funkcji include";
 echo "\n";
 include 'include_plik.php';
 echo "\nowoc: $owoc, kolor: $kolor";

 echo ' testuje require_once:';
 require_once('\xampp\htdocs\mojprojekt\include_plik.php');
 echo "\n";
 echo "\n";
 $a = 3;
 $b = 6;

 echo 'testuje if';
 if ($a < $b)
    echo "$b is bigger than $a. ";
echo "\n";
echo 'testuje if_else';
if ($b > $a){
    echo "$b is bigger than $a.";
} else {
    echo "$b is not bigger than $a.";
}
echo "\n";
echo 'testuje if .. elseif .. else ';
if ($a > $b) {
    echo "a is bigger than b";
} elseif ($a == $b) {
    echo "a is equal to b";
} else {
    echo "a is smaller than b";
}
echo "\n";
$i = 1;
echo "\n";
echo 'testuje switch';
switch ($i) {
    case 0:
        echo "i equals 0";
        break;
    case 1:
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;
}
echo "\n";
echo 'testuje while';
while ($i <=9){
    echo $i;
    $i++;
}
echo "\n";
echo 'testuje for';
for ($i = 1; $i <= 10; $i++) {
    echo $i;
}
echo "\n";
echo 'testuje $get:';
echo "\n";
$nazwa = $_GET('Edyta');
echo 'Hello'.$nazwa.'!';
echo "\n";
echo 'testuje $post';
echo 'Hello ' . htmlspecialchars($_POST["name"]).'!';
echo "\n";
echo 'testuje session';
session_start();
$_SESSION["newsession"]=$i;
?>
