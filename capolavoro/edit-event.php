<?php
require_once "db_connection.php";

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start']; // Nuova data di inizio
$end = $_POST['end']; // Vecchia data di fine

$sqlUpdate = "UPDATE tbl_events SET title='$title', start='$start' WHERE id=$id";
if(mysqli_query($conn, $sqlUpdate)) {
    echo "Evento aggiornato con successo!";
} else {
    echo "Errore nell'aggiornamento dell'evento: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
