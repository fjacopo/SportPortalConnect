<?php
require_once "db_connection.php";

// Ottenere l'ID dell'evento da eliminare
$id = $_POST['id'];

// Query per eliminare l'evento dal database
$sqlDelete = "DELETE FROM tbl_events WHERE id = $id";

// Esecuzione della query
mysqli_query($conn, $sqlDelete);

// Restituzione del numero di righe interessate
echo mysqli_affected_rows($conn);

// Chiusura della connessione al database
mysqli_close($conn);
?>
