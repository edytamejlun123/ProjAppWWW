<?
 error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
 /* po tym komentarzu będzie kod do dynamicznego ładowania stron */
?>

<!-- Dołączenie arkusza stylów CSS -->
<link rel="stylesheet" href="../css/style.css" type="text/css" />

<!-- Dołączenie skryptu JavaScript do kolorowania tła -->
<script src="../JavaScript/kolorujtlo.js" type = "text/javascript"></script>
	<head> 
		<!-- Dołączenie jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		 <!-- Ustalenie kodowania strony -->
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>

		<!-- Dołączenie skryptu JavaScript do obsługi czasu i daty -->
		<script src="../JavaScript/timedate.js" type="text/javascript"></script>
		 <!-- Ustalenie kodowania dla polskich znaków -->
		<meta http-equiv="Contebt-type" content="pl" />
		<!-- Ustalenie autora strony -->
		<meta name="Author" content="Edyta Mejlun" />
		<!-- Ustalenie tytułu strony -->
		<title> Największe mosty świata </title>
	</head>	
	<body class="body" onload="startclock()">
	<div class="container">
		<!-- Logo strony -->
		<div class="logo">
		<h1 class="tytul">		
			Największe mosty świata 
		</h1>
		</div>
		<!-- Nawigacja strony -->
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
				<th class="table"><a href="index.php?content=filmy">Filmy</a></th><br>
				<th class="table"><a href="sklep.php">SKLEP</a></th>
			</tr>		
		</div>
		<!-- Zawartość strony -->
		<div class="content">
		<?php 
		include('cfg.php');
		include('showpage.php');
		$strona = '';
			if($_GET['content'] == '')
			{ echo PokazPodstrone(7);}
			if($_GET['content'] == 'strona1')
			{ echo PokazPodstrone(1);}
			if($_GET['content'] == 'strona2')
			{ echo PokazPodstrone(2);}
			if($_GET['content'] == 'strona3')
			{ echo PokazPodstrone(3);}
			if($_GET['content'] == 'strona4')
			{ echo PokazPodstrone(4);}
			if($_GET['content'] == 'strKolorujTlo')
			{ echo PokazPodstrone(6);}
			if($_GET['content'] == 'strona5')
			{ echo PokazPodstrone(5);}
			if($_GET['content'] == 'stronaGlowna')
			{ echo PokazPodstrone(7);}
			if($_GET['content'] == 'filmy')
			{ echo PokazPodstrone(8);}
			if(file_exists($strona))
			{
				include($strona);
			}

		?>
		
		</div>
		<!-- dodatkowa zawartosc strony -->
		<div class="ad">
			<div id="zegarek" style="text-align: center;"></div>
			<div id="data" style="text-align: center;"> </div>


		<!-- stopka strony -->
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