<?php
session_start();

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username']) || !isset($_SESSION['ruolo'])) {
    // Reindirizza l'utente alla pagina di accesso se non è autenticato
    header("Location: index.php");
    exit();
}

// Connessione al database e inclusione del file di connessione
require_once "db_connection.php";

$userRole = $_SESSION['ruolo']; 
$cod_squadra = $_SESSION['cod_squadra']; 

// Definizione della query per ottenere gli utenti con lo stesso cod_squadra dell'utente loggato
$query = "SELECT * FROM users WHERE cod_squadra = ?";

// Preparazione della query
$stmt = $conn->prepare($query);

// Associazione dei parametri e dei valori
$stmt->bind_param("i", $_SESSION['cod_squadra']);

// Esegui la query
$stmt->execute();

// Ottieni il risultato della query
$result = $stmt->get_result();

// Ottieni i dati degli utenti
$utenti = $result->fetch_all(MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persone - Sport Portal Connect</title>
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
            width: 100%;
            margin: 20px auto;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            margin-top: 5px;
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

        .utenti-grid {
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            grid-gap: 20px;
        }

        
        .utente {
            background-color: #444; 
            padding: 20px; 
            border-radius: 8px; 
        }

        .utente:nth-child(even) {
            background-color: #555; 
        }

       


        button {
            background-color: #1e549f;
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
            background-color: #1a447a;
        }

        button:hover[id="removeuser"] {
            background-color: #f95959; 
        }   

        section {
            margin-bottom: 40px;
        }

        section h2 {
            margin-top: 0;
            font-size: 24px;
            border-bottom: 1px solid #555;
            padding-bottom: 10px;
            font-weight: normal;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            margin-bottom: 10px;
            font-weight: normal;
        }

        ul li a {
            color: #f95959;
            text-decoration: none;
        }

        ul li a:hover {
            text-decoration: underline;
        }

       

        .menu-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer; 
            height: auto;
        }        

        .menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 20px;
            background-color: rgba(56, 81, 112, 0.8);
            border-radius: 8px;
            padding: 10px;
            z-index: 1;
        }

        .menu a {
            display: block;
            color: #F1F1F2;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .menu a:hover {
            color: #5fc9f3;
        }

        .menu a[href="logout.php"]:hover {
            color: #f95959; 
        }

        @media (max-width: 300px) {
            .container {
                width: 80%;
            }

            .menu-icon {
                top: 20px;
                right: 10px;
                width: 25px;
            }

            .menu {
                top: 40px;
                right: 10px;
                width: 100px;
            }

            input[type="text"],
            input[type="password"],
            select {
                width: calc(100% - 20px);
            }
           
        }

        @media (min-width: 301px) and (max-width: 480px) {
            .container {
                width: 70%;
            }
            .menu-icon {
                top: 25px;
                right: 15px;
                width: 30px;
            }

            .menu {
                top: 40px;
                right: 15px;
                width: 150px;
            }
           
        }

        @media (min-width: 481px) and (max-width: 600px) {
            .container {
                width: 60%;
            }
            .menu-icon {
                top: 25px;
                right: 20px;
                width: 35px;
            }

            .menu {
                top: 40px;
                right: 20px;
                width: 180px;
            }
          
        }

        @media only screen and (min-width: 601px) and (max-width: 768px) {
            .container {
                width: 50%;
            }
            .menu-icon {
                top: 25px;
                right: 15px;
                width: 35px;
            }

            .menu {
                top: 40px;
                right: 15px;
                width: 180px;
            }
            
        }

        @media only screen and (min-width: 769px) and (max-width: 992px) {
            .container {
                width: 50%;
            }
            .menu-icon {
                top: 20px;
                right: 20px;
                width: 40px;
            }

            .menu {
                top: 40px;
                right: 20px;
                width: 200px;
            }
            
        }

        @media only screen and (min-width: 993px) and (max-width: 1200px) {
            .container {
                width: 50%;
            }
            .menu-icon {
                top: 20px;
                right: 25px;
                width: 50px;
            }

            .menu {
                top: 50px;
                right: 25px;
                width: 220px;
            }
           
        }

        @media only screen and (min-width: 1201px) {
            .container {
                width: 50%;
            }
            .menu-icon {
                top: 10px;
                right: 30px;
                width: 60px;
            }

            .menu {
                top: 45px;
                right: 30px;
                width: 240px;
            }
            
        }

        
    </style>
</head>
<body>
    <header>
        <h1>Persone</h1>
    </header>

    <div class="container">
        <img src="icon_menu_static.png" class="menu-icon" onclick="toggleMenu()" id="menu-icon">
        <div class="menu" id="menu">
            <?php if ($userRole === "Allenatore"): ?>
                <a href="home.php">Home</a>
                <a href="#">Chat</a>
                <a href="#">Allenamenti</a>
                <a href="calendario.php">Calendario</a>
                <a href="impostazioni.php">Impostazioni</a>
            <?php elseif ($userRole === "giocatore" || $userRole === "preparatore"): ?>
                <a href="home_giocatore.php">Home</a>
                <a href="#">Chat</a>
                <a href="#">Allenamenti</a>
                <a href="calendario.php">Calendario</a>
                <a href="impostazioni.php">Impostazioni</a>
            <?php else: ?>
                <a href="home_richiesta.php">Home</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </div>

        <h2>Elenco Utenti</h2>
    <div class="utenti-grid">
        <?php foreach ($utenti as $utente ): ?>
            <div class="utente">
                <p><?php echo $utente['ruolo']; ?></p>
                <p><?php echo $utente['nome'];?> <?php echo $utente['cognome']; ?></p>
                <p><?php echo $utente['username']; ?></p>
                <p><?php echo $utente['email']; ?></p>
                <?php if ($userRole === "Allenatore"): ?>
                    <form action="modifica_ruolo.php" method="post">
                       
                        </select>
                        <button type="submit">Modifica Ruolo</button>
                    </form>
                     <form action="rimuovi_utente.php" method="post" onsubmit="return confirm('Sei sicuro di voler rimuovere questo utente?');">
                        <input type="hidden" name="usernameToRemove" value="<?php echo $utente['username']; ?>">
                        <button type="submit" id="removeuser">Rimuovi</button>
                     </form>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>

</body>
</html>
