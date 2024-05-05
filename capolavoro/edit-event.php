<?php
require_once "db.php";

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

$sqlUpdate = "UPDATE tbl_events SET title='$title', start='$start', end='$end' WHERE id=$id";
if(mysqli_query($conn, $sqlUpdate)) {
    echo "Evento aggiornato con successo!";
} else {
    echo "Errore nell'aggiornamento dell'evento: " . mysqli_error($conn);
}
mysqli_close($conn);
?>