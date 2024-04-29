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

// Recupera i valori inviati dal form di login
$email_username = $_POST['username'];
$password = $_POST['password'];

// Prepara la query per selezionare l'utente dal database
$stmt = $conn->prepare("SELECT * FROM users WHERE (email = ? OR username = ?) AND password = ?");

// Verifica se la query è stata preparata con successo
if ($stmt === false) {
    die("Errore nella preparazione della query");
}

// Proteggi i dati da SQL injection
$stmt->bind_param("sss", $email_username, $email_username, $password);

// Esegui la query
$stmt->execute();

// Ottieni il risultato della query
$result = $stmt->get_result();

// Controlla se esiste un utente con le credenziali fornite
if ($result->num_rows > 0) {
    // L'utente esiste, reindirizzalo alla pagina di benvenuto
    header("Location: dashboard.php");
} else {
    // L'utente non esiste o le credenziali sono errate, reindirizzalo alla pagina di login con un messaggio di errore
    header("Location: login.php?error=1");
}

// Chiudi la connessione al database
$stmt->close();
$conn->close();
?>