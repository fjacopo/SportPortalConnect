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

// Recupera l'ID della richiesta dalla richiesta POST
$request_id = $_POST['request_id'];

// Recupera i dettagli della richiesta
$stmt = $conn->prepare("SELECT username, cod_squadra FROM richieste_giocatori WHERE id = ?");
$stmt->bind_param("i", $request_id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se la richiesta esiste
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $cod_squadra = $row['cod_squadra'];

    // Rimuovi la richiesta dalla tabella richieste_giocatori
    $stmt_delete_request = $conn->prepare("DELETE FROM richieste_giocatori WHERE id = ?");
    $stmt_delete_request->bind_param("i", $request_id);
    $result_delete_request = $stmt_delete_request->execute();

    // Aggiorna il cod_squadra dell'utente nella tabella users
    $stmt_update_user = $conn->prepare("UPDATE users SET cod_squadra = ? WHERE username = ?");
    $stmt_update_user->bind_param("ss", $cod_squadra, $username);
    $result_update_user = $stmt_update_user->execute();

    if ($result_delete_request && $result_update_user) {
        // Operazioni completate con successo
        echo "success";
    } else {
        // Errore nell'aggiornamento
        echo "error";
    }
} else {
    // Nessuna richiesta trovata
    echo "not_found";
}

// Chiudi le query e la connessione al database
$stmt->close();
$stmt_delete_request->close();
$stmt_update_user->close();
$conn->close();
?>
