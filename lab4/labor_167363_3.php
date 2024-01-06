<?php
    $nr_indeksu='167363';
    $nrGrupy='3';

    echo 'Edyta Mejlun '.$nr_indeksu.' grupa '.$nrGrupy.' <br/> <br/>';

    echo '<br/>Zastosowanie metody include() <br/> ';
    include 'include.php' ;
    echo '<br/>';

    echo '<br/>Zastosowanie metody require_once() <br/> ';
    require_once('include.php');
    echo 'wyświetlam zmienną która jest w pliku include.php: '.$zmienna. '<br/>';

    echo '<br/>Zastosowanie warunku if() i else <br/> ';
    $age = 25;

    if ($age >= 18) {
        echo "Jesteś pełnoletni.";
    } else {
        echo "Jesteś niepełnoletni.";
    }

    echo "<br/><br/> zastosowanie warunku elseif <br/>";

    $score = 85;

    if ($score >= 90) {
        echo "Ocena: 5";
    } elseif ($score >= 80) {
        echo "Ocena: 4";
    } elseif ($score >= 70) {
        echo "Ocena: 3";
    } else {
        echo "Ocena: 2";
    }

    echo "<br/><br/> Zastosowanie warunku switch <br/>";
    $day = "poniedziałek";

    switch ($day) {
        case "poniedziałek":
            echo "Dziś jest poniedziałek.";
            break;
        case "wtorek":
            echo "Dziś jest wtorek.";
            break;
        case "środa":
            echo "Dziś jest środa.";
            break;
        default:
            echo "Dziś jest inny dzień.";
            break;
    }

    echo "<br/><br/> Zastosowanie pętli while() <br/>";
    $count = 0;

    while ($count < 5) {
        echo "Licznik: $count <br>";
        $count++;
    }

    echo "<br/> Zastosowanie pętli for() <br/>";
    for ($i = 0; $i < 5; $i++) {
        echo "Wartość zmiennej i: $i <br>";
    }
    
    echo "<br/>Zastosowanie dla typów zmiennych $ _ GET <br/>";
    $id = $_GET['id']; //http://localhost/moj_projekt/labor_167363_3.php?id=234
    echo 'wartosc echo: '.$id.'<br/>'; //wartosc echo: 234

    $username = $_POST['username'];
    $password = $_POST['password'];
    echo "username: " .$username. "<br/>";
    echo "password: " .$password. "<br/>";

    echo "<br/> Zastosowanie typu $ _ session: <br/>";
    session_start();
    $_SESSION['user_id'] = 443;
    $_SESSION['username'] = 'Jan Nowak';
    $userID = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    unset($_SESSION['username']);
    echo "userID: " .$userID. "<br/>";
    echo "username: " .$username. "<br/>";
    session_unset(); // Wyczyści wszystkie zmienne sesji
    session_destroy(); // Zakończy sesję

?>