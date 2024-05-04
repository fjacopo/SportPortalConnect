<?php
session_start();

// Connessione al database (da sostituire con le tue credenziali)
$servername = "localhost";
$username = "jacopo";
$password = "Dianaidra24?";
$dbname = "sport_portal_db";

// Connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    // Reindirizzo alla pagina di accesso se l'utente non è autenticato
    header("Location: login.php");
    exit;
}

// Controllo se è stato inviato il modulo di eliminazione account
if (isset($_POST['delete_account'])) {
    
    $username = $_SESSION['username'];
    $sql = "DELETE FROM users WHERE username = '$username'";
    if ($conn->query($sql) === TRUE) {
        // Eliminazione avvenuta con successo, effettuo il logout
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
    } else {
        // Errore durante l'eliminazione dell'account
        echo "Errore durante l'eliminazione dell'account: " . $conn->error;
    }
}

// Chiudi la connessione al database
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimina Account - Sport Portal Connect</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial Black, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #f1f1f2;
        }

        header {
            background-color: #1e549f;
            color: #f1f1f2;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        h1, h2 {
            margin-top: 0;
            font-size: 25px;
            font-weight: normal;
        }

        p {
            font-size: 16px;
            font-weight: normal;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: normal;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #555;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: Arial Black, Arial, sans-serif;
            background-color: #444;
            color: #f1f1f2;
        }

        button {
            background-color: #f95959;
            color: #f1f1f2;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: normal;
            font-family: Arial Black, Arial, sans-serif;
        }

        button:hover {
            background-color: #d23c3c;
        }

        footer {
            background-color: #1e549f;
            color: #f1f1f2;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
            font-weight: normal;
        }

    </style>
</head>
<body>
    <header>
        <h1>Elimina Account</h1>
    </header>

    <div class="container">
        <p>Sei sicuro di voler eliminare il tuo account? Questa azione non può essere annullata.</p>
        <form action="" method="POST">
            <button type="submit" name="delete_account">Elimina Account</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Sport Portal Connect. Tutti i diritti riservati.</p>
    </footer>
</body>
</html>
