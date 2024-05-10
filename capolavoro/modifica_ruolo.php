<?php
session_start();

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username']) || !isset($_SESSION['ruolo'])) {
    // Reindirizza l'utente alla pagina di accesso se non è autenticato
    header("Location: index.php");
    exit();
}

// Controllo se è stato inviato un metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se l'utente loggato è un Allenatore
    if ($_SESSION['ruolo'] === "Allenatore") {
        // Connessione al database e inclusione del file di connessione
        require_once "db_connection.php";

        // Esegui la sanitizzazione del valore ricevuto dal form
        $nuovoRuolo = htmlspecialchars($_POST['nuovoRuolo']);
        $username = htmlspecialchars($_POST['username']);

        // Query per aggiornare il ruolo dell'utente nel database
        $query = "UPDATE users SET ruolo = ? WHERE username = ?";

        // Preparazione della query
        $stmt = $conn->prepare($query);

        // Associazione dei parametri e dei valori
        $stmt->bind_param("ss", $nuovoRuolo, $username);

        // Esegui la query
        if ($stmt->execute()) {
            // Se l'aggiornamento ha avuto successo, reindirizza alla pagina delle persone
            header("Location: persone.php");
            exit();
        } else {
            // Se si verifica un errore, gestiscilo qui
            echo "Si è verificato un errore durante l'aggiornamento del ruolo.";
        }

        // Chiudi la connessione
        $conn->close();
    } else {
        // Se l'utente non è un Allenatore, reindirizza alla pagina delle persone
        header("Location: persone.php");
        exit();
    }
} else {
    // Se non è stato inviato un metodo POST, reindirizza alla pagina delle persone
    header("Location: persone.php");
    exit();
}
?>