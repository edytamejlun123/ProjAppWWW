<link rel="stylesheet" href="../css/style_kontakt.css">
<?php

function PokazKontakt(){
    $wynik= '
    <div class = "kontakt">
        <form action="mail.php"  method="post">
        <h1 class="h1_s"> FORMULARZ KONTAKTOWY </h1>
        <table class = "tabela">
        <tr><td class="formularz">Temat: </td><td class="formularz"><input type="textarea" name="temat"  /></td></tr>
        <tr><td class="formularz">Tresc: </td><td class="formularz"><input type="text" name="tresc"  /></td></tr>
        <tr><td class="formularz">E-mail: </td><td class="formularz"><input type="text" name="email"  /></td></tr>
        <tr><td class="formularz"> </td><td class="formularz"><input type="submit" name="x1_submit"  value="Wyślij e-mail" /></td></tr>
        </table>
        </form>
    </div>
    ';
    
    return $wynik;
    
}
 

function WyslijMailKontakt($odbiorca){
    if(empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email']) )
    {
        echo '[nie_wypelniles_pola]';
        echo PokazKontakt();
    }
    else{
        $mail['subject'] = htmlspecialchars($_POST['temat']) ;
        $mail['body'] = htmlspecialchars($_POST['tresc']);
        $mail['sender'] = htmlspecialchars($_POST['email']);
        $mail['reciptient'] = $odbiorca;

        $header = "Form: formularz kontaktowy <" .$mail['sender'] ."> \n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding:";
        $header .= "X-Sender: <" .$mail['sender']. ">\n";
        $header .= "X-Mailer: PRapwww mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <" .$mail['sender']. ">\n";

        mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
        echo '[wiadomosc_wyslana]';
    }

}

function PrzypomnijHaslo(){

}


echo PokazKontakt();

?>