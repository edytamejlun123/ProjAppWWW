<link rel="stylesheet" href="../css/style_zarzadzaj.css">

<?php
//naglowek strony
echo '

<h1 class="naglowek">
    SKLEP
</h1>
<a href="index.php?content="" ">Powrot</a>
';
include ('../html/cfg.php');
echo '<div>';

session_start();

//Funkcja wysweitla produkty dostepne w sklepie
function Produkty_sklep(){

global $link;

    $query = "SELECT * FROM kategorie WHERE matka = 0 ORDER BY id ASC";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<div class="produkty"> ';
        while ($row = mysqli_fetch_assoc($result)) {
            $query_podkategorie = "SELECT * FROM kategorie WHERE matka = " . $row['id'] . " ";
            $result_podkategorie = mysqli_query($link, $query_podkategorie);
            echo '<h2 >'.$row['nazwa'] . '</h2>' ;
            while ($row_podkategorie = mysqli_fetch_assoc($result_podkategorie)) {
                echo '<p>' .$row_podkategorie['nazwa'] .'; id: '. $row_podkategorie['id']. '</p>' ;
                $query_produkty = "SELECT * FROM produkty WHERE kategoria = ". $row_podkategorie['id']."" ;
                $result_produkty = mysqli_query($link, $query_produkty);
                while($row_produkty = mysqli_fetch_assoc($result_produkty) ){
                    if($row_produkty['status_dostępności'] == 1 && $row_produkty['data_wygaśnięcia'] >= date('Y-m-d')){
                        echo ' <form method="POST" action="sklep.php?funkcja=dodaj&id='.$row_produkty['id'].'"><table > <tr>';
                        foreach ($row_produkty as $key => $value) {
                            if ($key === 'zdjęcie') {
                                echo " <td> <img src='data:image/*;base64," . base64_encode($value) . "' alt='Obraz' width='100px' style = 'margin: 20px'> </td>";
                            }
                        }
                        echo '<td>' .$row_produkty['tytuł'] . '</td>' ;
                        $cena_brutto = $row_produkty['cena_netto'] + ($row_produkty['cena_netto']*$row_produkty['podatek_vat'] );
                        echo '<td> cena brutto: <input type="hidden" name="cena" value='.$cena_brutto.' />'. $cena_brutto .' </td>' ;
                        echo '<td> <input type = "number" name="ilosc" value="1" > </td>';
						echo ' <td> <input type="hidden" name="ile_w_magazynie" value="' . $row_produkty['ilość_w_magazynie'] . '">';
                        echo ' <td> <input type="hidden" name="product_id" value="' . $row_produkty['id'] . '">
						<!-- przycisk dodaj do koszyka -->
						<input type="submit" name="addToCart" value="Dodaj do koszyka"></td>';
                        echo '</tr> </table> </form>';
                    }  
                                     
                }
            }
        }
        echo '</div>';
    } else {
		//komunikat gdy nie ma dostepnych prodeuktow w sklepie
        echo '<p style="text-align: center">brak kategorii do wyświetlenia. </p>';
    }
	//dodawanie wybranego produktu do koszyka 
    if( isset($_POST['addToCart']) && isset($_GET['id']) && isset($_GET['funkcja'])){
		$ile_w_magazynie = $_POST['ile_w_magazynie'];
		$ile_sztuk = $_POST['ilosc'];
        if($_GET['funkcja'] == 'dodaj'){
			if( $ile_w_magazynie > $ile_sztuk){
			
            if(!isset($_SESSION['count']))
			{
				$_SESSION['count'] = 1;
			}
			else
			{	
				$_SESSION['count']++;
			}
            $nr = $_SESSION['count'];
			$id_prod = $_POST['product_id'];
			$cena = $_POST['cena'];
			$ile_sztuk = $_POST['ilosc'];

            if($ile_sztuk < 1)
			{
				$ile_sztuk = 1;
			}
            $query = "SELECT * FROM produkty WHERE id='$id_prod' LIMIT 1";
			$result = mysqli_query($link ,$query);
			$row = mysqli_fetch_array($result);
            $x = 1;
		
			while($x < $_SESSION['count'])
			{
				if($_SESSION[$x.'_1'] == $id_prod)
				{
					$_SESSION[$x.'_2'] += $ile_sztuk;
					$_SESSION[$x.'_6'] += $cena * $ile_sztuk;
					
					// jeśli przekroczymy ilość sztuk w magazynie, to ustawiana jest ilość sztuk w magazynie
					
					if($_SESSION[$x.'_2'] > $row['ilość_w_magazynie'])
					{
						$_SESSION[$x.'_2'] = $row['ilość_w_magazynie'];
						$_SESSION[$x.'_6'] = $cena * $row['ilość_w_magazynie'];
					}
					$_SESSION[$x.'_3'] = time();
					$_SESSION['count']--;
					
					// przekierowywujemy do koszyk.php
					
					echo "<script>window.location.href='sklep.php';</script>";
					exit();
				}
			
				$x++;
            }

            $prod[$nr]['id_prod'] = $id_prod;
			$prod[$nr]['ile_sztuk'] = $ile_sztuk;
			$prod[$nr]['data'] = time();
			$prod[$nr]['tytul'] = $row['tytuł'];
			$prod[$nr]['cena_jednostkowa'] = $cena;
			$prod[$nr]['cena_łączna'] = $cena * $prod[$nr]['ile_sztuk']; 
			$prod[$nr]['obraz'] = $row['zdjęcie'];
            
            $nr_0 = $nr.'_0';
			$nr_1 = $nr.'_1';
			$nr_2 = $nr.'_2';
			$nr_3 = $nr.'_3';
			$nr_4 = $nr.'_4';
			$nr_5 = $nr.'_5';
			$nr_6 = $nr.'_6';
			$nr_7 = $nr.'_7';

            $_SESSION[$nr_0] = $nr;
			$_SESSION[$nr_1] = $prod[$nr]['id_prod'];
			$_SESSION[$nr_2] = $prod[$nr]['ile_sztuk'];
			$_SESSION[$nr_6] = $prod[$nr]['cena_łączna'];

            if($_SESSION[$nr_2] > $row['ilość_w_magazynie'])
			{
				$_SESSION[$nr_2] = $row['ilość_w_magazynie'];
				$_SESSION[$nr_6] = $cena * $row['ilość_w_magazynie'];
			}
			$_SESSION[$nr_3] = $prod[$nr]['data'];
			$_SESSION[$nr_4] = $prod[$nr]['tytul'];      
			$_SESSION[$nr_5] = $prod[$nr]['cena_jednostkowa'];    
			   
			$_SESSION[$nr_7] = $prod[$nr]['obraz'];  
			
			// przekierowywujemy do koszyk.php
			
			echo "<script>window.location.href='sklep.php';</script>";
		}else{
			echo '<b> nie ma tyle na stanie  </b>';
		}
        }
    }


}

//funkcja wyswietlajaca zawartosc koszyka
function ShowCart()
{
    $suma = 0;
    echo ' <div class="koszyk_css" > ';
    echo '<h2> KOSZYK  </h2> ';

    if(isset($_SESSION['count'])){        
    
    echo ' <table > 
	<tr> <td>  </td> <td>  </td> 
	<td> ilość: </td>
	<td> cena brutto </td> <td>  </td> </tr> ';
    $x = 1;
    while( $x <= $_SESSION['count'] ){
        $suma += $_SESSION[$x.'_6'];
        echo '
					<tr>				
						<td class="ooo"><b><img src="data:image/jpeg;base64,'.base64_encode($_SESSION[$x.'_7']).'" height="50"/></b></td>
						<td class="tdid"><b>'.$_SESSION[$x.'_4'].'</b></td>
						<td class="tdnazwa">'.$_SESSION[$x.'_2'].'</td>
						<td class="tdane">'.$_SESSION[$x.'_5'].'</td>
						<td class="tdane">'.$_SESSION[$x.'_6'].'</td>
						<td class="tdusun"><a href="sklep.php?funkcja=usun&nr='.$_SESSION[$x.'_0'].'"><b>Usuń</b></a></td>
						
					</tr>
				';
			
			$x++;
    }
    echo '
				<tr>	
					<td></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="tsumapr"><b>Suma: </b></td>
					<td class="tsumalw">'.$suma.'</td>
					<td class="tdusun"><a href="sklep.php?funkcja=wyczysc"><b>Wyczyść</b></a></td>
					<td class="tdedytuj"><a href="sklep.php?funkcja=zamow"><b>Zamów</b></a></td>
					<td></td><td></td>			
				</tr>				
				</table></center><br>
			';	


    echo '</table>';

    }
    
    else
	{
		echo 'Brak produktów w koszyku</center></div>';
	}
    echo '</div> ';
}

ShowCart();

function removeFromCard()
{
	if(isset($_GET['nr']))
	{
		$nr = $_GET['nr'];
		
		if($nr == $_SESSION['count'])
		{
			// jeśli produkt jest na końcu koszyka
			
			unset($_SESSION[$nr.'_0']);
			unset($_SESSION[$nr.'_1']);
			unset($_SESSION[$nr.'_2']);
			unset($_SESSION[$nr.'_3']);
			unset($_SESSION[$nr.'_4']);
			unset($_SESSION[$nr.'_5']);
			unset($_SESSION[$nr.'_6']);
			unset($_SESSION[$nr.'_7']);
		}
		else
		{
			// jeśli produkt nie jest na końcu koszyka
			
			for($x = $nr; $x < $_SESSION['count'] ; $x++)
			{
				$t = $x + 1;
				$_SESSION[$x.'_1'] = $_SESSION[$t.'_1'];
				$_SESSION[$x.'_2'] = $_SESSION[$t.'_2'];
				$_SESSION[$x.'_3'] = $_SESSION[$t.'_3'];
				$_SESSION[$x.'_4'] = $_SESSION[$t.'_4'];
				$_SESSION[$x.'_5'] = $_SESSION[$t.'_5'];
				$_SESSION[$x.'_6'] = $_SESSION[$t.'_6'];
				$_SESSION[$x.'_7'] = $_SESSION[$t.'_7'];
			}
			
				unset($_SESSION[$_SESSION['count'].'_0']);
				unset($_SESSION[$_SESSION['count'].'_1']);
				unset($_SESSION[$_SESSION['count'].'_2']);
				unset($_SESSION[$_SESSION['count'].'_3']);
				unset($_SESSION[$_SESSION['count'].'_4']);
				unset($_SESSION[$_SESSION['count'].'_5']);
				unset($_SESSION[$_SESSION['count'].'_6']);
				unset($_SESSION[$_SESSION['count'].'_7']);
		}
		
		// jeśli usunęliśmy jedyny produkt w koszyku
		
		$_SESSION['count']--;
		if($_SESSION['count'] == 0)
		{
			unset($_SESSION['count']);
		}
		
		// przekierowanie do koszyk.php
		
		echo "<script>window.location.href='sklep.php';</script>";
		exit();
	}
}

if(isset($_GET['funkcja']) && $_GET['funkcja'] == 'usun')
{
	removeFromCard();
}

if(isset($_GET['funkcja']) && $_GET['funkcja'] == 'wyczysc'){
	session_destroy();
	echo ' <script>window.location.href="sklep.php";</script> ';
	exit();
}
if(isset($_GET['funkcja']) && $_GET['funkcja'] == 'usun')
{
	removeFromCard();
}

if(isset($_GET['funkcja']) && $_GET['funkcja'] == 'zamow')
{
	session_destroy();
	echo ' <script>window.location.href="zamowienie.php";</script> ';
	exit();
}

echo '</div>';
Produkty_sklep();
// Koszyk();
?>
