<?php
require_once "db_connection.php";
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
    header("Location: register_coach.php");
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
    echo "<script>alert('Nome utente già esistente.');</script>";
    echo "<script>window.location.href='register_coach.php';</script>";    
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
    echo "<script>alert('Email già esistente.');</script>";
    echo "<script>window.location.href='register_coach.php';</script>";
    
    exit();
}

// Genera un codice squadra casuale
function generateRandomTeamCode($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$codiceSquadra = generateRandomTeamCode();

// Prepara la query per inserire l'utente nel database
$stmt = $conn->prepare("INSERT INTO users (nome, cognome, data_nascita, email, username, password, ruolo, cod_squadra) VALUES (?, ?, ?, ?, ?, ?, 'Allenatore', ?)");

// Verifica se la query è stata preparata con successo
if ($stmt === false) {
    die("Errore nella preparazione della query");
}

// Proteggi i dati da SQL injection
$stmt->bind_param("sssssss", $nome, $cognome, $data_nascita, $email, $username, $hashed_password, $codiceSquadra);

// Esegui la query
$result = $stmt->execute();

// Controlla se l'inserimento è avvenuto con successo
if ($result) {
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
