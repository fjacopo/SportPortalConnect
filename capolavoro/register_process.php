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

// Recupera i valori inviati dal form di registrazione
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$data_nascita = $_POST['data_nascita'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Verifica se le password coincidono
if ($password !== $confirm_password) {
    // Password non corrispondenti, reindirizza alla pagina di registrazione con un messaggio di errore
    header("Location: register.php?error=password");
    exit();
}

// Hash della password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepara la query per inserire l'utente nel database
$stmt = $conn->prepare("INSERT INTO users (nome, cognome, data_nascita, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");

// Verifica se la query è stata preparata con successo
if ($stmt === false) {
    die("Errore nella preparazione della query");
}

// Proteggi i dati da SQL injection
$stmt->bind_param("ssssss", $nome, $cognome, $data_nascita, $email, $username, $hashed_password);

// Esegui la query
$result = $stmt->execute();

// Controlla se l'inserimento è avvenuto con successo
if ($result) {
    // Registrazione avvenuta con successo, reindirizza alla pagina di login
    header("Location: index.php");
} else {
    // Errore durante la registrazione, reindirizza alla pagina di registrazione con un messaggio di errore
    header("Location: register.php?error=registration");
}

// Chiudi la connessione al database
$stmt->close();
$conn->close();
?>