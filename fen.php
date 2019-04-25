<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Echiquier FEN</title>
 
	<style>
		h1 			  { text-align:center; }
		table 	      { border-collapse: collapse; margin:0 auto;}
		td 	      	  { width:50px; height:50px; padding:0}
		.clair	      { background:#FCFAE1;}
		.sombre	      { background:#BD8D46;}
		.img	      { margin:0;padding:0;}
		#contenu      { width:700px; margin: 0 auto; }
	</style>
  
	<script>
		function init(){
		document.getElementById("fen").setAttribute('value','rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR');
	}
	</script>
</head>
<body>
<div id="contenu">

<h1>Affichage de la position des pi&egrave;ces de l'&eacute;chiquer selon la notation FEN</h1>

<table>
<?php

// DÃ©finition de $fen en fonction du POST ou position par dÃ©faut.
if (!isset($_POST['submit'])) {
  $fen="r3k2r/1bppnppp/p1p5/2b1Pq2/5N2/2N5/PPP2PPP/R1BQ1RK1"; // r=roi, b=dame, n=fou, k=tour, q=cavalier, p=pion
} else {
  $fen=$_POST['fen'];
}

//Transformation de la chaine en tableau (par ligne)
$fentableau = explode("/", $fen);

// CrÃ©ation du tableau d'images
$imagestableau = [
    "R" => "tour_b.png",
    "B" => "fou_b.png",
    "N" => "cavalier_b.png",
    "K" => "roi_b.png",
    "Q" => "dame_b.png",
    "P" => "pion_b.png",

    "r" => "tour_n.png",
    "b" => "fou_n.png",
    "n" => "cavalier_n.png",
    "k" => "roi_n.png",
    "q" => "dame_n.png",
    "p" => "pion_n.png",
];

$ligmax=8;
$colmax=8;

for ($lig=0; $lig<$ligmax; $lig++){
	echo "<tr>";

	for ($col=0; $col<$colmax; $col++){

		$couleur=(($lig+$col)%2==0)?"clair":"sombre";

    if(is_numeric($fentableau[$lig][$col])){
      $repeat=str_repeat('x',$fentableau[$lig][$col]); // A chaque fois que l'on a un nombre on rÃ©pÃ¨te x autant de fois
      $fentableau[$lig]=str_replace($fentableau[$lig][$col],$repeat,$fentableau[$lig]); //Puis, on remplace cette sÃ©rie dans le tableau
	  
	   
	  
    }

    if(array_key_exists($fentableau[$lig][$col],$imagestableau)){
      $piece=$imagestableau[$fentableau[$lig][$col]];
    }
    else {
      $piece= "vide.png";
    }
    echo "<td class=\"$couleur\"><img src=\"img/$piece\" alt=\"\" /> </td>";
    }

	echo "</tr>";
}

//print_r($fentableau);
?>


</table>

<p>&nbsp;</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  FEN: <input id="fen" type="text" name="fen" size="60" value="<?php echo $fen; ?>" />
  <input type="submit" name="submit" value="OK">
  <input type="button" name="initial" value="Pos. initiale" onClick="init();"/>
</form>

</div>
</body>
</html>
