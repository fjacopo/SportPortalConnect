<?php
session_start();

require_once "db_connection.php";

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    // Reindirizzo alla pagina di accesso se l'utente non è autenticato
    header("Location: login.php");
    exit;
}

// Controllo se è stato inviato il modulo di eliminazione account
if (isset($_POST['delete_account'])) {
    
    $username = $_SESSION['username'];
    
    // Elimina l'account dalle richieste_giocatori se presente
    $delete_request_stmt = $conn->prepare("DELETE FROM richieste_giocatori WHERE username = ?");
    $delete_request_stmt->bind_param("s", $username);
    $delete_request_stmt->execute();
    
    // Elimina l'account dalla tabella users
    $delete_user_stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    $delete_user_stmt->bind_param("s", $username);
    
    if ($delete_user_stmt->execute()) {
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

        .btn {
            color: #f1f1f2;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: normal;
            font-family: Arial Black, Arial, sans-serif;
            margin-right: 10px;
        }

        .btn-danger {
            background-color: #f95959;
        }

        .btn-danger:hover {
            background-color: #d23c3c;
        }

        .btn-secondary {
            background-color: #1e549f;
            
        }
        a.btn-secondary {
             text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #174280;
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
            <button type="submit" name="delete_account" class="btn btn-danger">Elimina Account</button>
            <a href="javascript:history.go(-1)" class="btn btn-secondary">Annulla</a>
        </form>
    </div>

    
</body>
</html>
