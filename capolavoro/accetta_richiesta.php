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
$stmt = $conn->prepare("SELECT username, cod_squadra, ruolo FROM richieste_giocatori WHERE id = ?");
$stmt->bind_param("i", $request_id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se la richiesta esiste
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $cod_squadra = $row['cod_squadra'];
    $ruolo_selezionato = $row['ruolo']; // Aggiunto per recuperare il ruolo dalla richiesta

    // Mappa il ruolo selezionato alla stringa corrispondente "Giocatore" o "Preparatore"
    $ruolo = ($ruolo_selezionato === 'giocatore') ? 'Giocatore' : 'Preparatore';

    // Rimuovi la richiesta dalla tabella richieste_giocatori
    $stmt_delete_request = $conn->prepare("DELETE FROM richieste_giocatori WHERE id = ?");
    $stmt_delete_request->bind_param("i", $request_id);
    $result_delete_request = $stmt_delete_request->execute();

    // Aggiorna il cod_squadra e il ruolo dell'utente nella tabella users
    $stmt_update_user = $conn->prepare("UPDATE users SET cod_squadra = ?, ruolo = ? WHERE username = ?");
    $stmt_update_user->bind_param("sss", $cod_squadra, $ruolo, $username); // Aggiunto il parametro per il ruolo
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
