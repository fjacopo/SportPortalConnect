<?php
require_once "db_connection.php";

session_start();

$cod_squadra = $_SESSION['cod_squadra'];

// Query per recuperare gli eventi dal database
 $sqlQuery = "SELECT * FROM tbl_events WHERE cod_squadra = '$cod_squadra' ORDER BY id";


// Esecuzione della query
$result = mysqli_query($conn, $sqlQuery);

// Array per memorizzare gli eventi
$eventArray = array();

// Ciclo attraverso i risultati e aggiunta degli eventi all'array
while ($row = mysqli_fetch_assoc($result)) {
    array_push($eventArray, $row);
}

// Liberazione della memoria del risultato
mysqli_free_result($result);

// Chiusura della connessione al database
mysqli_close($conn);

// Restituzione degli eventi sotto forma di JSON
echo json_encode($eventArray);
?>
