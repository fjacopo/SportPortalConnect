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

       
@media (max-width: 300px) {
    .container {
        padding: 20px;
    }
    h1, h2 {
        font-size: 20px;
    }
    p {
        font-size: 14px;
    }
    button {
        padding: 8px 16px;
        font-size: 14px;
    }
}

@media (min-width: 301px) and (max-width: 480px) {
    .container {
        padding: 30px;
    }
    h1, h2 {
        font-size: 22px;
    }
    p {
        font-size: 17px;
    }
    button {
        padding: 10px 20px;
        font-size: 17px;
    }
}


@media (min-width: 481px) and (max-width: 600px) {
    .container {
        padding: 40px;
    }
    h1, h2 {
        font-size: 24px;
    }
    p {
        font-size: 18px;
    }
    button {
        padding: 12px 24px;
        font-size: 18px;
    }
}


@media only screen and (min-width: 601px) and (max-width: 768px) {
    .container {
        padding: 50px;
    }
    h1, h2 {
        font-size: 26px;
    }
    p {
        font-size: 20px;
    }
    button {
        padding: 14px 28px;
        font-size: 20px;
    }
}


@media only screen and (min-width: 769px) and (max-width: 992px) {
    .container {
        padding: 60px;
    }
    h1, h2 {
        font-size: 26px;
    }
    p {
        font-size: 19px;
    }
    button {
        padding: 16px 32px;
        font-size: 18px;
    }
}


@media only screen and (min-width: 993px) and (max-width: 1200px) {
    .container {
        padding: 70px;
    }
    h1, h2 {
        font-size: 25px;
    }
    p {
        font-size: 20px;
    }
    button {
        padding: 18px 36px;
        font-size: 20px;
    }
}


@media only screen and (min-width: 1201px) {
    .container {
        padding: 80px;
    }
    h1, h2 {
        font-size: 25px;
    }
    p {
        font-size: 20px;
    }
    button {
        padding: 20px 40px;
        font-size: 20px;
    }
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
