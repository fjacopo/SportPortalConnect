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

// Recupera i dati inviati dal form di registrazione
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$data_nascita = $_POST['data_nascita'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


// Verifica se le password coincidono
if ($password !== $confirm_password) {
    // Le password non coincidono, mostra un messaggio di errore
    header("Location: register_coach.php?error=password");
    exit();
}

// Hash della password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Controlla se il nome utente esiste già nel database
$stmt_username = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt_username->bind_param("s", $username);
$stmt_username->execute();
$result_username = $stmt_username->get_result();

// Controlla se esiste un record con lo stesso nome utente
if ($result_username->num_rows > 0) {
    // Il nome utente esiste già nel database, mostra un messaggio di errore
    header( "<script>alert('Questo nome utente è già in uso.');</script>");
    header("Location: register_coach.php");
    exit();
}

// Controlla se l'email esiste già nel database
$stmt_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt_email->bind_param("s", $email);
$stmt_email->execute();
$result_email = $stmt_email->get_result();

// Controlla se esiste un record con la stessa email
if ($result_email->num_rows > 0) {
    // L'email esiste già nel database, mostra un messaggio di errore
    header ("<script>alert('Questa password é giá registrata.');</script>");
    header("Location: register_coach.php");
    exit();
}


// Prepara la query per inserire i dati nel database
$stmt = $conn->prepare("INSERT INTO users (nome, cognome, data_nascita, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");

// Verifica se la query è stata preparata con successo
if ($stmt === false) {
    die("Errore nella preparazione della query");
}

// Proteggi i dati da SQL injection
$stmt->bind_param("ssssss", $nome, $cognome, $data_nascita, $email, $username, $hashed_password);

// Esegui la query
$result = $stmt->execute();

$query = "UPDATE users SET ruolo = 'Allenatore' WHERE username = ?";
    $stmt_allenatore = $conn->prepare($query);
    $stmt_allenatore->bind_param('s', $username);
    $stmt_allenatore->execute();

if  ($result) {
    // Inserimento dei dati nel database avvenuto con successo
    echo "<script>alert('Registrazione completata con successo.');</script>";
    echo "<script>window.location.href='index.php';</script>";
} else {
    // Errore durante l'inserimento dei dati nel database
    echo "<script>alert('Errore durante la registrazione.');</script>";
    echo "<script>window.location.href='register_coach.php';</script>";
}

// Chiudi la connessione al database
$stmt->close();
$conn->close();
?>