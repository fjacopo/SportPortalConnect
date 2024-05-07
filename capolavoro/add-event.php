<?php
// Inizia la sessione
session_start();
require_once "db_connection.php";

// Prendi i dati dall'input POST
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$location = $_POST['location'];

// Prendi il cod_squadra dell'utente loggato dalla sessione
$cod_squadra = $_SESSION['cod_squadra'];

// Query per inserire un nuovo evento nel database, incluso il cod_squadra
$sql = "INSERT INTO tbl_events (title, start, end, location, cod_squadra) VALUES ('$title', '$start', '$end', '$location', '$cod_squadra')";

if ($conn->query($sql) === TRUE) {
    echo "Evento aggiunto con successo";
} else {
    echo "Errore: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
