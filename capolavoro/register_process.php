<?php
// Includi il file di connessione al database
include 'db_connection.php';

// Recupera i dati inviati dal form di registrazione
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$data_nascita = $_POST['data_nascita'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$ruolo = $_POST['ruolo'];

// Cripta la password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query per verificare se l'email o il nome utente esiste già nel database
$sql = "SELECT * FROM users WHERE email = ? OR username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Utente o email già esistente
    header("Location: register.php?error=1");
} else {
    // Inserisci l'utente nel database con la password criptata
    $sql = "INSERT INTO users (nome, cognome, data_nascita, email, username, password, ruolo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nome, $cognome, $data_nascita, $email, $username, $passwordHash, $ruolo);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php?success=1");
}

$conn->close();
?>