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

// Recupera il nome utente o l'email e la password inviati dal form di login
$identifier = $_POST['username'];
$password = $_POST['password'];

// Prepara la query per selezionare l'utente dal database utilizzando il nome utente o l'email
$stmt = $conn->prepare("SELECT username, email, password FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $identifier, $identifier);

// Esegui la query
$stmt->execute();

// Ottieni il risultato della query
$result = $stmt->get_result();

// Controlla se l'utente esiste nel database
if ($result->num_rows === 0) {
    // L'utente non esiste nel database, mostra un messaggio di errore
    echo "<script>alert('NOME UTENTE O EMAIL NON VALIDI .); window.location.href='index.php';</script>";
} else {
    // L'utente esiste nel database, ottieni il nome utente, l'email e la password criptata
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $hashed_password = $row['password'];

    // Verifica se la password inserita corrisponde alla password nel database
    if (password_verify($password, $hashed_password)) {
        // Password corretta, reindirizza alla pagina di dashboard
        header("Location: home.php");
        exit(); // Assicura che lo script termini qui e non prosegua oltre
    } else {
        // Password errata, mostra un messaggio di errore e torna alla pagina di login
        echo "<script>alert('PASSWORD ERRATA .'); window.location.href='index.php';</script>";
    }
}

// Chiudi la connessione al database
$stmt->close();
$conn->close();
?>