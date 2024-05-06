<?php
// Connessione al database
$servername = "localhost";
$username = "jacopo";
$password = "Dianaidra24?";
$dbname = "sport_portal_db";

// Crea una connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Prendi i dati dall'input POST
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$location = $_POST['location'];

// Query per inserire un nuovo evento nel database
$sql = "INSERT INTO tbl_events (title, start, end, location) VALUES ('$title', '$start', '$end', '$location')";

if ($conn->query($sql) === TRUE) {
    echo "Evento aggiunto con successo";
} else {
    echo "Errore: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
