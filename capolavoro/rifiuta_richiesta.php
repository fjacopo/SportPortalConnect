<?php
require_once "db_connection.php";

// Verifica che la richiesta sia stata inviata tramite metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica che l'ID della richiesta sia stato ricevuto
    if (isset($_POST["request_id"])) {
        // Recupera l'ID della richiesta dalla richiesta POST
        $request_id = $_POST["request_id"];


        // Cancella la richiesta dal database
        $sql = "DELETE FROM richieste_giocatori WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();

        // Chiudi la connessione
        $conn->close();
    }
}
?>