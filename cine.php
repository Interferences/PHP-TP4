<!DOCTYPE html>
<html>
 
	<head>
		<meta charset="UTF-8">
		<title>Films</title>
	</head>
 
	<body>
	
	<table>
	
		<tr>
			<th>Titre</th>
			<th>Année</th>
			<th>Genre</th>
			<th>Réalisateur</th>
		</tr>
	
	<?php
		
		$link=mysqli_connect("dwarves.iut-fbleau.fr", "philippe", "quentinphpmyadmin", "philippe");
			if(!$link){
				die("<p>connexion impossible</p>");
			}
	
    $requete=mysqli_query($link,"SELECT F.titre,F.annee,F.genre, A.nom FROM Film F, Artiste A WHERE F.idMes = A.idArtiste");
    $req=mysqli_query($link, "SELECT DISTINCT A.nom FROM Artiste A JOIN Film F ON (F.idMes = A.idArtiste)");
    
    echo "<form method='GET' action='cine.php'>";
      echo "<select name='nom' size='1'>";
      
      foreach($req as $res){
       echo "<option>" . $res['nom'];
      }
    
     echo "</select> ";
     echo "<input type='submit' value='chercher'>";     
    echo "</form>"; 
    
    $tst=0;
    
    if(isset($_GET['nom'])){
      $nom=$_GET['nom'];
      $requeteComp=mysqli_query($link, "SELECT F.titre,F.annee,F.genre, A.nom FROM Film F, Artiste A WHERE F.idMes = A.idArtiste AND A.nom = '".$nom."' ");
      $tst=1;
    }
       
    if($tst == 1){
      if($requeteComp){
      foreach($requeteComp as $res){
        echo "<tr>";
			  echo "<td>" . $res['titre'] . "</td>" . "<td>" . $res['annee'] . "</td>" . "<td>" . $res['genre'] . "</td>" . "<td>" . $res['nom'] . "</td>";
			  echo "</tr>";
        } 
      }
   }
    
    if($tst == 0){
      if($requete){
        foreach($requete as $film){
          echo "<tr>";
			    echo "<td>" . $film['titre'] . "</td>" . "<td>" . $film['annee'] . "</td>" . "<td>" . $film['genre'] . "</td>" . "<td>" . $film['nom'] . "</td>";
			     echo "</tr>";
       }
     }
   }	
	
	?>
	
	
	</table>
	
	</body>
</html>