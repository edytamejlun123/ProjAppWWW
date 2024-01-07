<?
 error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
 /* po tym komentarzu będzie kod do dynamicznego ładowania stron */
?>

<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../JavaScript/kolorujtlo.js" type = "text/javascript"></script>
	<head> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
		<script src="../JavaScript/timedate.js" type="text/javascript"></script>
		<meta http-equiv="Contebt-type" content="pl" />
		<meta name="Author" content="Edyta Mejlun" />
		<title> Największe mosty świata </title>
	</head>	
	<body class="body" onload="startclock()">
	<div class="container">
		
		<div class="logo">
		<h1 class="tytul">		
			Największe mosty świata 
		</h1>
		</div>
		
		<div class="nav">
			<h2 style = "text-align: center;">
				MENU
			</h2>
			<tr>
				<th class="table"><a href="index.php?content=stronaGlowna">Strona Główna</a> </th> <br>
				<th class="table"><a href="index.php?content=strona1">Galeria</a> </th> <br>
				<th class="table"><a href="index.php?content=strona2">Ranking</a></th> <br>
				<th class = "table"><a href="index.php?content=strona3">Mosty wiszące</a></th> <br>
				<th class = "table"><a href="index.php?content=strona4">Inne</a></th> <br>
				<th class = "table"><a href="index.php?content=strKolorujTlo">Koloruj Tło</a></th> <br>
				<th class="table"><a href="index.php?content=strona5">Kontakt</a></th><br>
				<th class="table"><a href="index.php?content=filmy">Filmy</a></th>
			</tr>		
		</div>
		
		<div class="content">
		<?php 
			if (isset($_GET['content'])) {
			$content = $_GET['content'];
			$allowedContents = array('index', 'strona1', 'strona2', 'strona3', 'strona4', 'strona5', 'strKolorujTlo', 'filmy');

				if (in_array($content, $allowedContents)) {
					include($content . '.php');
				} else {
					include ('glowna.php'); // Lub inna strona domyślna dla błędnego contentu
				}
			} else {
				include ('glowna.php'); // Lub inna strona domyślna, gdy nie ma ustawionego contentu
			}
		?>
		
		</div>

		<div class="ad">
			<div id="zegarek" style="text-align: center;"></div>
			<div id="data" style="text-align: center;"> </div>


			
		</div>
		<div class="footer">
			author: Edyta Mejłun, Największe mosty świata.
		</div>

	</div>

	<?php
	$nr_indeksu = '167363';
	$nrGrupy = '3';
	echo 'Autor: Edtya Mejłun ' . $nr_indeksu . ' grupa ' . $nrGrupy . ' <br /><br />';
	?>
	
		</body>