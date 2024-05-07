<?php
// Connessione al database
require_once "db_connection.php";
// Controlla se sono stati inviati dati tramite POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica che tutti i campi siano stati ricevuti
    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['location'])) {
        // Recupera i dati inviati tramite POST
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $location = $_POST['location'];

        // Esegui la query per aggiornare l'evento nel database
        // Assicurati di utilizzare le pratiche di sicurezza per prevenire le vulnerabilità SQL
        $sql = "UPDATE tbl_events SET title='$title', start='$start', end='$end', location='$location' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            // Invia una risposta di successo se l'aggiornamento ha avuto successo
            echo "Evento aggiornato con successo";
        } else {
            // Invia un messaggio di errore se si è verificato un problema durante l'aggiornamento
            echo "Errore durante l'aggiornamento dell'evento: " . mysqli_error($conn);
        }

        // Chiudi la connessione al database
        mysqli_close($conn);
    } else {
        // Invia un messaggio di errore se non sono stati ricevuti tutti i dati necessari
        echo "Errore: Dati mancanti per l'aggiornamento dell'evento";
    }
} else {
    // Invia un messaggio di errore se la richiesta non è una richiesta POST
    echo "Errore: Solo richieste POST sono consentite per questa pagina";
}
?>
