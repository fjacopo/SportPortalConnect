<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .register-container {
            width: 400px;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .register-container form {
            display: grid;
            grid-gap: 10px;
            text-align: left;
        }

        .register-container label {
            font-weight: bold;
        }

        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"],
        .register-container input[type="date"],
        .register-container select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .register-container select {
            width: 100%;
        }

        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: #0056b3;
        }

        .register-container p {
            margin-top: 15px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrazione</h2>
        <form action="register_process.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" pattern="[A-Za-z]+" title="Inserisci solo lettere" required>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" pattern="[A-Za-z]+" title="Inserisci solo lettere" required>
            <label for="data_nascita">Data di nascita:</label>
            <input type="date" id="data_nascita" name="data_nascita" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="username">Nome utente:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="ruolo">Ruolo:</label>
            
            <button type="submit">Registrati</button>
        </form>
        <p>Hai già un account? <a href="index.php">Accedi qui</a>.</p>
    </div>
    <script>
        // Calcola la data massima (5 anni prima rispetto ad oggi)
        var today = new Date();
        var maxDate = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());

        // Formatta la data massima come stringa per l'attributo "max" dell'input date
        var maxDateFormatted = maxDate.toISOString().split('T')[0];

        // Imposta la data massima per l'input date
        document.getElementById('data_nascita').setAttribute('max', maxDateFormatted);
    </script>
</body>
</html>