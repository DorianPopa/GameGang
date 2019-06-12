<?php

// datele de conectare la serverul de baze de date
$host = 'localhost';
$db   = 'GameGang';
$user = 'root';
$pass = 'root';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// optiuni vizand maniera de conectare
$opt = [
	// erorile sunt raportate ca exceptii de tip PDOException
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // rezultatele vor fi disponibile in tablouri asociative
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // conexiunea e persistenta
    PDO::ATTR_PERSISTENT 		 => TRUE
];
