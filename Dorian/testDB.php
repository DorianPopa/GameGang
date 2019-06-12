<?php

require ("config/parametersDB.php");

try {
	// instantiem un obiect PDO
  	$pdo = new PDO ($dsn, $user, $pass, $opt);

  	// pregatim comanda SQL parametrizata
  	$sql = $pdo->prepare ('SELECT * FROM users ORDER BY id');

  	// daca s-a putut executa...
	if ($sql->execute()) {
		// ...preluam fiecare inregistrare gasita
  		while ($row = $sql->fetch()) {
  			// ...si o afisam (coloana tabelei e cheie a tabloului asociativ)
    		echo '<p>' . $row['id'] . '__' . $row['username'] . '__' . $row['password'] . '__' . $row['realName'] . '__'. $row['joinDate'] . '.</p>';
    	}	
  	}
  } catch (PDOException $e) {
  	echo "Eroare: " . $e->getMessage(); // mesajul exceptiei survenite
};
