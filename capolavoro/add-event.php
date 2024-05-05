<?php
require_once "db.php";

$title = $_POST['title'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$location = $_POST['location'];

$sqlInsert = "INSERT INTO tbl_events (title, start, end, location) VALUES ('$title', '$startDate', '$endDate', '$location')";
if(mysqli_query($conn, $sqlInsert)) {
    echo "Evento aggiunto con successo!";
} else {
    echo "Errore nell'aggiunta dell'evento: " . mysqli_error($conn);
}
mysqli_close($conn);
?>