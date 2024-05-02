<?php
// Connessione al database
$servername = "localhost";
$username = "jacopo";
$password = "Dianaidra24?";
$dbname = "sport_portal_db";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verifica se è stata inviata una richiesta POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se il campo "username" è stato inviato
    if (isset($_POST["username"])) {
        // Recupera l'username dalla richiesta POST
        $username = $_POST["username"];
        

        // Verifica la connessione
        if ($conn->connect_error) {
            die("Connessione al database fallita: " . $conn->connect_error);
        }

        // Query per aggiungere l'utente alla squadra e aggiornare il ruolo
        $update_query = "UPDATE users SET cod_squadra = 'nomesquadra', ruolo = 'nuovoruolo' WHERE username = '$username'";
        
        if ($conn->query($update_query) === TRUE) {
            // Query per rimuovere l'utente dalla tabella delle richieste
            $delete_query = "DELETE FROM richieste_giocatori WHERE username = '$username'";
            
            if ($conn->query($delete_query) === TRUE) {
                // Reindirizza alla home dopo aver accettato la richiesta
                header("Location: home.php");
                exit; // Assicura che lo script si interrompa qui dopo il reindirizzamento
            } else {
                echo "Errore durante l'eliminazione della richiesta: " . $conn->error;
            }
        } else {
            echo "Errore durante l'aggiornamento dell'utente: " . $conn->error;
        }

        // Chiudi la connessione al database
        $conn->close();
        
    } else {
        // Se il campo "username" non è stato inviato, restituisci un errore
        http_response_code(400); // Bad Request
        echo "Il campo 'username' non è stato fornito nella richiesta.";
    }
} else {
    // Se la richiesta non è di tipo POST, restituisci un errore
    http_response_code(405); // Method Not Allowed
    echo "Sono consentite solo richieste POST per questo endpoint.";
}
?>