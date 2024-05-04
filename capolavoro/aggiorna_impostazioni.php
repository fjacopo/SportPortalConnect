<?php
session_start();

// Connessione al database
$servername = "localhost";
$username = "jacopo";
$password = "Dianaidra24?";
$dbname = "sport_portal_db";

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal modulo HTML
    $username = $_SESSION['username']; // Username dell'utente loggato
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verifica se la password corrente è corretta
    $stmt_check_password = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt_check_password->bind_param("s", $username);
    $stmt_check_password->execute();
    $stmt_check_password->store_result();

    if ($stmt_check_password->num_rows == 1) {
        $stmt_check_password->bind_result($hashed_password);
        $stmt_check_password->fetch();

        if (password_verify($current_password, $hashed_password)) {
            // La password corrente è corretta, procedi con l'aggiornamento

            // Verifica se la nuova password e la conferma corrispondono
            if ($new_password === $confirm_password) {
                // Cripta la nuova password
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Aggiorna i dati dell'utente nel database
                $stmt_update_user = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $stmt_update_user->bind_param("ss", $hashed_new_password, $username);
                $stmt_update_user->execute();

                // Controlla se l'aggiornamento è stato eseguito con successo
                if ($stmt_update_user->affected_rows > 0) {
                    echo "<script>alert('Modifiche aggiornate.');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Errore nel salvataggio delle modifiche.');history.back();</script>";
                }
            } else {
                echo "<script>alert('Le password non coincidono.');history.back();</script>";
            }
        } else {
            echo "<script>alert('Password errata.');history.back();</script>";
        }
    } else {
        echo "<script>alert('Utente non trovato.');history.back();</script>";
    }

    // Chiudi le query e la connessione al database
    $stmt_check_password->close();
    
    $conn->close();
}
?>
