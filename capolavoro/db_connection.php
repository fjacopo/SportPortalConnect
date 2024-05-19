<?php
// Configurazione del database
$servername = "localhost";
$username = "jacopo10";
$password = "Dianaidra24?";
$dbname = "sport_portal_db";

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
?>