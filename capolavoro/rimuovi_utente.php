<?php
session_start();

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username']) || !isset($_SESSION['ruolo'])) {
    // Reindirizza l'utente alla pagina di accesso se non è autenticato
    header("Location: login.php");
    exit();
}

// Connessione al database e inclusione del file di connessione
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se è stata inviata una richiesta POST
    
    // Ottieni l'username dell'utente da rimuovere dalla richiesta POST
    $usernameToRemove = $_POST['usernameToRemove'];

    // Query per aggiornare il campo cod_squadra e ruolo dell'utente a NULL
    $query = "UPDATE users SET cod_squadra = NULL, ruolo = NULL WHERE username = ?";
    
    // Prepara la query
    $stmt = $conn->prepare($query);

    // Associa i parametri e i valori
    $stmt->bind_param("s", $usernameToRemove);

    // Esegui la query
    if ($stmt->execute()) {
        // Se l'aggiornamento è avvenuto con successo, reindirizza alla pagina precedente
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Se si verifica un errore durante l'esecuzione della query, visualizza un messaggio di errore
        echo "Si è verificato un errore durante la rimozione dell'utente.";
    }

    // Chiudi la connessione al database
    $stmt->close();
    $conn->close();
} else {
    // Se la richiesta non è di tipo POST, reindirizza alla pagina precedente
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
