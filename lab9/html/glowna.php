<!-- Tresc strony glownej -->

Mosty to nie tylko majestatyczne konstrukcje, lecz symbole ludzkiego geniuszu i determinacji. 
Od starożytnych czasów, gdy mosty były znakiem postępu, aż po dzisiejsze monumentalne konstrukcje, te gigantyczne budowle stanowią łącznik między ludźmi, kulturami i ekonomiami.
Mosty, takie jak Wielki Mur Chiński, zapewniały nie tylko fizyczne połączenie, ale też umożliwiały rozwój handlu, wymianę kulturową i wzmacniały więzi między społecznościami. 
Przez wieki mosty odgrywały kluczową rolę w rozwoju cywilizacji, ułatwiając transport, komunikację i przemieszczanie się ludzi oraz towarów.
Dzisiaj, mosty takie jak Wielki Most w Chinach czy Most Akashi-Kaikyo w Japonii, są nie tylko osiągnięciami inżynieryjnymi, ale także symbolami jednoczenia ludzi i miejsc. 
Stanowiąc niezwykłe połączenie technologii, designu i ludzkiego zaangażowania, te gigantyczne konstrukcje inspirują i stanowią fundament globalnej współpracy.
Na stronie będziesz mógł odkryć więcej fascynujących szczegółów na temat tych mostów, ich historii i wpływie na rozwój społeczny oraz ekonomiczny. Zapraszam do 
zgłębiania świata największych mostów, które od wieków budują nie tylko połączenia materialne, ale również duchowe między ludźmi.
<br><br>
<!-- Wstawienie obrazu mostu na stronie głównej -->
<img src="../img/most_stronaglowna.jpg" style = "width: 650px; height:320px;">

<!-- Sekcja animacji z blokiem do klikania -->
<div id="animacjaTestowa1" class="test-block"> Kliknij, a się powiększę </div>

<!-- Skrypt dla animacji po kliknięciu -->
	<script>
		$("#animacjaTestowa1").on("click", function(){
			$(this).animate({
				width: "500px",
				opacity: 0.4,
				fontsize: "3em",
				borderwidth: "10px"
			}, 1500);
		});
	</script>

<!-- Sekcja animacji z blokiem do klikania -->
<div id="animacjaTestowa2" class="test-block"> Najedź kursorem, a się powiększe</div>

<!-- Sekcja animacji z blokiem do klikania -->
<script>
	$("#animacjaTestowa2").on({
		"mouseover" : function(){
			$(this).animate({
				width: 300
			}, 800);
		}, 
		"mouseout" : function(){
			$(this).animate({
				width: 200
			}, 800);
		}
	});
</script>

<!-- Sekcja animacji z blokiem do klikania -->
<div id="animacjaTestowa3" class = "test-block"> Klikaj, abym urusł.</div>
<!-- Sekcja animacji z blokiem do klikania -->
<script>
	$("#animacjaTestowa3").on("click", function(){
		if(!$(this).is(":animated")){
			$(this).animate({
				width: "+=" + 50,
				height: "+=" + 10,
				opacity: "-=" + 0.1,
				duration: 3000
			});
		}
	});
</script>

