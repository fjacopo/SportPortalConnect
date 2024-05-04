<?php
// Avvia la sessione
session_start();

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
$username = $_POST['username'];
$password = $_POST['password'];

// Prepara la query per selezionare l'utente dal database utilizzando il nome utente o l'email
$stmt = $conn->prepare("SELECT username, email, password, ruolo, cod_squadra FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $username);

// Esegui la query
$stmt->execute();

// Ottieni il risultato della query
$result = $stmt->get_result();

// Controlla se l'utente esiste nel database
if ($result->num_rows === 0) {
    // L'utente non esiste nel database, mostra un messaggio di errore
    echo "<script>alert('Nome utente o Email non esistente.');</script>";
    echo "<script>window.location.href='index.php';</script>";

} else {
    // L'utente esiste nel database, ottieni il nome utente, l'email, la password criptata, il ruolo e il codice squadra
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $hashed_password = $row['password'];
    $ruolo = $row['ruolo'];
    $cod_squadra = $row['cod_squadra'];

    // Verifica se la password inserita corrisponde alla password nel database
    if (password_verify($password, $hashed_password)) {
        // Password corretta
        
        // Memorizza l'username dell'utente loggato nella sessione
        $_SESSION['username'] = $username;
        $_SESSION['ruolo'] = $ruolo;
        $_SESSION['email'] = $email;
        $_SESSION['cod_squadra'] = $cod_squadra;

        if ($ruolo === "Allenatore") {
            // Se l'utente è un allenatore, reindirizza alla home dell'allenatore
            header("Location: home.php");
        } else {
            // Altrimenti, controlla se l'utente ha un codice squadra associato
            if ($cod_squadra !== NULL) {
                // Se l'utente ha un codice squadra, reindirizza alla home del giocatore
                header("Location: home_giocatore.php");
            } else {
                // Se l'utente non ha un codice squadra, reindirizza alla pagina delle richieste
                header("Location: home_richiesta.php");
            }
        }
        exit(); 
    } else {
        // Password errata, mostra un messaggio di errore e torna alla pagina di login
        echo "<script>alert('Password errata.');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
}

// Chiudi la connessione al database
$stmt->close();
$conn->close();
?>