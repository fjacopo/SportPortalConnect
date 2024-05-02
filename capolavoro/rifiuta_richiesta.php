<?php
// Connessione al database
$servername = "localhost";
$username = "jacopo";
$password = "Dianaidra24?";
$dbname = "sport_portal_db";

// Verifica che la richiesta sia stata inviata tramite metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica che l'ID della richiesta sia stato ricevuto
    if (isset($_POST["request_id"])) {
        // Recupera l'ID della richiesta dalla richiesta POST
        $request_id = $_POST["request_id"];

        // Crea una connessione
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la connessione
        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

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