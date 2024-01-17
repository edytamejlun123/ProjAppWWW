<link rel="stylesheet" href="../css/style_zarzadzaj.css">

<?php

//rozpoczęcie sesji i dołączenie pliku konfiguracyjnego
session_start();
include ('../html/cfg.php');
echo '<h1 class="naglowek">ZARZADZAJ KATEGORIAMI</h1>';


//funkcja wyświetlająca liste kategorii i podkategorii
function ListaKategorii()
{
    echo '<h2 style="text-align: center"> LISTA KATEGORII </h2>';
    global $link;
    $query = "SELECT * FROM kategorie WHERE matka = 0 ORDER BY id ASC";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            $query_podkategorie = "SELECT * FROM kategorie WHERE matka = " . $row['id'] . " ";
            $result_podkategorie = mysqli_query($link, $query_podkategorie);
            echo '<li style="color: red; margin-left: 38%"> ' . $row['nazwa'] . '; id: '. $row['id'].'</li>';
            while ($row_podkategorie = mysqli_fetch_assoc($result_podkategorie)) {
                echo '<ul> <li style="color: dark; margin-left: 39%">' . $row_podkategorie['nazwa'] .'; id: '. $row_podkategorie['id']. '</li> </ul>';
            }
        }
        echo '</ul>';
    } else {
        echo '<p style="text-align: center">brak kategorii do wyświetlenia. </p>';
    }
}


//funkcja obslugujaca usuwanie kategorii
function fun_delete()
{
    
    global $link;
    $query = "SELECT * FROM kategorie ORDER BY nazwa ASC";
    $result = mysqli_query($link, $query);

    echo '
    <h2 style="text-align: center"> USUN </h2>
    <form method="POST">
        
        <select name="categories" id="categories" style="width: 200px; margin-top: 10px">
        <option value="" selected disabled hidden>Wybierz kategorię</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option> ' . $row['nazwa'] . ' </option>';
    }

    echo '</select>
        <br><input type="submit" name="usun" value="OK" style="width: 200px; margin-top: 10px">
    </form>';

    if (isset($_POST['usun'])) {
        if (!empty($_POST['categories'])) {
            $selected = $_POST['categories'];

            $delete_id_query = "SELECT id, matka FROM kategorie WHERE nazwa = '$selected'";
            $delete_id_result = mysqli_query($link, $delete_id_query);

            if ($delete_id_result && mysqli_num_rows($delete_id_result) > 0) {
                $row = mysqli_fetch_assoc($delete_id_result);
                $delete_id = $row['id'];
                $czy_matka = $row['matka'];

                if ($czy_matka == 0) {
                    // Kategoria jest matką, sprawdź czy ma podkategorie
                    $czy_podkategorie_query = "SELECT COUNT(*) AS count FROM kategorie WHERE matka = '$delete_id'";
                    $czy_podkategorie_result = mysqli_query($link, $czy_podkategorie_query);

                    if ($czy_podkategorie_result) {
                        $podkategorie_row = mysqli_fetch_assoc($czy_podkategorie_result);
                        $ilosc_podkategorii = $podkategorie_row['count'];

                        if ($ilosc_podkategorii > 0) {
                            echo '<p style="text-align: center"> Usun najpierw wszystkie podkategorie nalezace do tej kategorii. </p>';
                        } else {
                            // Brak podkategorii, usuń kategorię
                            UsunKategorie($delete_id);
                        }
                    } else {
                        echo '<p style="text-align: center">Błąd podczas sprawdzania podkategorii:  </p>' . mysqli_error($link);
                    }
                } else {
                    // Kategoria nie jest matką, usuń bez dodatkowych sprawdzeń
                    UsunKategorie($delete_id);
                }
            } else {
                echo " " . mysqli_error($link);
            }
        } else {
            echo ' ';
        }
    }
    
}

//funkcja dzieki ktorej usuwamy kategorie
function UsunKategorie($delete_id)
{
    global $link;
    $query = "DELETE FROM kategorie WHERE id = '$delete_id' ";
    $result = mysqli_query($link, $query);

    if (!$result) {
        echo " ";
    } else {
        echo "Rekord został pomyślnie usunięty! <script>window.location.href='kategorie.php';</script>";
        exit();
    }
}
  
//funkcja dzieki ktorej dodajemy nowa kategorie
function DodajKategorie(){
    global $link;
    $queryKategorie = "SELECT * FROM kategorie WHERE matka = 0 ORDER BY id ASC";
    $resultKategorie = mysqli_query($link, $queryKategorie);

    
    echo '
        <h2 style="text-align: center"> DODAJ NOWA KATEGORIE </h2>
        
        <form method="POST" action="">
            Nazwa: <br> 
            <input type="text" name="nazwa" required style="width: 200px; margin-top: 10px">
            
            <br>Matka:<br>
            <input type="text" name="matka" required style="width: 200px; margin-top: 10px">

            <input type="submit" name="dodaj" value="Dodaj">
        </form>';
    if(isset($_POST['dodaj']) && isset($_POST['nazwa']) && isset($_POST['matka']) ){
        $nazwa = $_POST['nazwa'];
        $matka = $_POST['matka'];
        $query = "INSERT INTO kategorie (id, matka, nazwa) VALUES (NULL,'$matka', '$nazwa')  ";
        $result = mysqli_query($link, $query);
        if ($result){
            echo " <script>window.location.href='kategorie.php';</script> ";
            exit();
        }
        else{
            echo 'Blad: ' .mysqli_error($link);
        }    
}}


//funkcja do edycji kategorii
function EdytujKategorie() {
    global $link;

    echo '
        <h2 style="text-align: center"> EDYTUJ KATEGORIE </h2>
        <form method="POST" action="">
        <br>id:<br>
            <input type="text" name="id1" required style="width: 200px; margin-top: 10px">

           <br> Nazwa: <br> 
            <input type="text" name="nazwa1" required style="width: 200px; margin-top: 10px">
            
            <br>Matka:<br>
            <input type="text" name="matka1" required style="width: 200px; margin-top: 10px">
            
            <input type="submit" name="edytuj" value="Edytuj">
        </form>
    ';
    if(isset($_POST['edytuj'])){
        $id = $_POST['id1'];
        $nazwa = $_POST['nazwa1'];
        $matka = $_POST['matka1'];
        $query = "SELECT * FROM kategorie WHERE id = ' $id' LIMIT 1";
        $result = mysqli_query($link, $query);
        $row= mysqli_fetch_array($result);

        if(is_null($row)){
            echo '<center>Nie istnieje kategoria o id '.$id.'!</center>';
			exit();
        }

        $query = "UPDATE kategorie SET nazwa = '$nazwa', matka = '$matka' WHERE id = '$id' LIMIT 1";
		$result = mysqli_query($link, $query);
		if($result) 
		{  
			echo "<script>window.location.href='kategorie.php';</script>";
			exit();
		} 
		else 
		{
			echo "<center>Błąd podczas edycji: ".mysqli_error($link)."</center>";
		}
    }
}

ListaKategorii();
fun_delete();
DodajKategorie();
EdytujKategorie();
?>
