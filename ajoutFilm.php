<!DOCTYPE html>
<html>
 
	<head>
		<meta charset="UTF-8">
		<title>Artistes</title>
	</head>
 
	<body>
	
	<table>
	
		<tr>
		  <th>Titre</th>
			<th>Genre</th>
		</tr>
	
	<?php
		
		$link=mysqli_connect("dwarves.iut-fbleau.fr", "philippe", "quentinphpmyadmin", "philippe");
			if(!$link){
				die("<p>connexion impossible</p>");
			}

    $requete=mysqli_query($link,"SELECT F.titre,F.annee,F.genre, A.nom FROM Film F, Artiste A WHERE F.idMes = A.idArtiste");
    $genre=mysqli_query($link, "SELECT DISTINCT genre FROM Film");
    $pays=mysqli_query($link, "SELECT DISTINCT codePays FROM Film");
    $realisateur=mysqli_query($link, "SELECT DISTINCT A.nom FROM Artiste A JOIN Film F ON (F.idMes = A.idArtiste)");
   
    echo "<h1>Ajouter un Film</h1>";
    
    
    echo "<form method='GET' action='ajoutFilm.php'>"; 
    
    echo "Genre :";
    echo "<select name='genre' size='1'>";
      
      foreach($genre as $res){
       echo "<option>" . $res['genre'];
      }
     echo "</option>"; 
     echo "</select><br><br>";
    
      echo "Pays :";
     echo "<select name='pays' size='1'>";
      
      foreach($pays as $res){
       echo "<option selected='selected'>" . $res['codePays'];
      }
      echo "</option>";
      echo "</select><br><br>";
    
    echo "Nom : ";
     echo "<select name='nom' size='1'>";
      
      foreach($realisateur as $res){
       echo "<option>" . $res['nom'];
      }
      echo "</option>";
     echo "</select><br><br>";
    
    echo "Resume : ";
      echo "<textarea rows='8' cols='30' name='resume'></textarea><br><br>";  
      
      echo "Annee : ";
      echo "<input type='text' name='annee'><br><br>";
     
     echo "<input type='submit' value='Ajoutez'><br><br>";
          
    echo "</form>";
    
    extract($_GET);
    
    if(isset($titre) && ($genre) && ($annee)){
      $query = "INSERT INTO Film(titre,genre,annee,resume) values (?,?,?)";
      $stmt = mysqli_prepare($link, $query);
      mysqli_stmt_bind_param($stmt, "sss",$titre, $genre, $annee, $resume);
      mysqli_stmt_execute($stmt);
      echo "INSERT INTO Artiste(titre,genre,annee,resume) values ('".$titre."','".$genre."','".$resume."','"$annee"')";
      
      $requete=mysqli_query($link,"SELECT A.nom,A.prenom,A.anneeNaiss FROM Artiste A");
    
    }
    
   echo "<h1>Listes des Artistes</h1>";         
    
      if($requete){
        foreach($requete as $Film){
          echo "<tr>";
			    echo "<td>" . $Film['titre'] . "</td>" . "<td>" . $Film['genre'] . "</td>";
			     echo "</tr>";
       }
     }	
	
	?>
	
	
	</table>
	
	</body>
</html>