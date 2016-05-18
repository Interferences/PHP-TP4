<!DOCTYPE html>
<html>
 
	<head>
		<meta charset="UTF-8">
		<title>Artistes</title>
	</head>
 
	<body>
	
	<table>
	
		<tr>
		  <th>Artiste</th>
			<th>Annee</th>
		</tr>
	
	<?php
		
		$link=mysqli_connect("dwarves.iut-fbleau.fr", "philippe", "quentinphpmyadmin", "philippe");
			if(!$link){
				die("<p>connexion impossible</p>");
			}
	
    $requete=mysqli_query($link,"SELECT A.nom,A.prenom,A.anneeNaiss FROM Artiste A");
        
    echo "<h1>Ajouter un Artiste</h1>";
    
    
    echo "<form method='GET' action='ajoutArtiste.php'>"; 
    echo "Nom : ";
    echo "<input type='text' name='nom'><br><br>";
    echo "Prenom :";
    echo "<input type='text' name='prenom'><br><br>";
    echo"Annee : ";
    echo "<input type='text' name='annee'><br><br>";
      
    echo "<input type='submit' value='Ajoutez'><br><br>";
          
    echo "</form>";
    
    extract($_GET);
    if(isset($nom) && ($prenom) && ($annee)){
      $query = "INSERT INTO Artiste(nom,prenom,anneeNaiss) values (?,?,?)";
      $stmt = mysqli_prepare($link, $query);
      mysqli_stmt_bind_param($stmt, "sss",$nom, $prenom, $annee);
      mysqli_stmt_execute($stmt);
      echo "INSERT INTO Artiste(nom,prenom,anneeNaiss) values ('".$nom.",'".$prenom.",'".$annee.")";
      
      $requete=mysqli_query($link,"SELECT A.nom,A.prenom,A.anneeNaiss FROM Artiste A");
    
    }
    
   echo "<h1>Listes des Artistes</h1>";         
    
      if($requete){
        foreach($requete as $Art){
          echo "<tr>";
			    echo "<td>" . $Art['nom'] .' '. $Art['prenom'] . "</td>" . "<td>" .  "<td>" . $Art['anneeNaiss'] . "</td>";
			     echo "</tr>";
       }
     }	
	
	?>
	
	
	</table>
	
	</body>
</html>