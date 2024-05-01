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

// Controllo se il giocatore fa parte di una squadra
$is_part_of_team = false; // Imposta questa variabile a true se il giocatore fa parte di una squadra

// Se il giocatore è già parte di una squadra, reindirizza alla home
if ($is_part_of_team) {
    header("Location: home.php");
    exit();
}

// Se il giocatore non fa parte di una squadra e ha inviato una richiesta di unione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera il codice squadra inviato dal form
    $cod_squadra = $_POST['cod_squadra'];

    // Query per verificare se il codice squadra esiste nel database
    $stmt = $conn->prepare("SELECT * FROM users WHERE cod_squadra = ?");
    $stmt->bind_param("s", $cod_squadra);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se il codice squadra esiste nel database
    if ($result->num_rows > 0) {

        $id = $_SESSION['id'];
        
        // Query per inserire la richiesta nella tabella richieste_giocatori
        $insert_stmt = $conn->prepare("INSERT INTO richieste_giocatori (id) VALUES (?)");
        $insert_stmt->bind_param("is", $id, $cod_squadra);
        $insert_stmt->execute();
        
        // Reindirizza alla home del giocatore dopo l'invio della richiesta
        header("Location: home_giocatore.php");
        exit();
    } else {
        // Se il codice squadra non esiste, mostra un messaggio di errore
        echo "<script>alert('Il codice squadra non esiste.');</script>";
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
    <title>Sport Portal Connect</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: "Arial Black", Arial, sans-serif;
            background-color: #081f37;
            color: #F1F1F2;
            position: relative;
        }

        .container {
            width: 90%;
            max-width: 2200px; 
            margin: 20px auto;
            background-color: #1e549f;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .name-design {
            width: 60%; 
            height: auto; 
            max-height: 300px; 
            object-fit: cover; 
            object-position: center; 
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
                padding: 10px;
            }

            .menu-icon {
                top: 10px;
                right: 10px;
                width: 25px;
            }

            .menu {
                top: 30px;
                right: 10px;
                width: 100px;
            }

            .name-design {
                max-height: 150px; 
                width: 100%; 
            }
        }

        @media (min-width: 301px) and (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .menu-icon {
                top: 15px;
                right: 15px;
                width: 30px;
            }

            .menu {
                top: 40px;
                right: 15px;
                width: 150px;
            }

            .name-design {
                max-height: 200px; 
                width: 90%; 
            }
        }

        @media (min-width: 481px) and (max-width: 600px) {
            .container {
                padding: 30px;
            }

            .menu-icon {
                top: 20px;
                right: 20px;
                width: 35px;
            }

            .menu {
                top: 50px;
                right: 20px;
                width: 180px;
            }

            .name-design {
                max-height: 250px; 
                width: 85%; 
            }
        }
    
        @media only screen and (min-width: 601px) and (max-width: 768px) {
            .container {
                padding: 30px;
            }

            .menu-icon {
                top: 15px;
                right: 15px;
                width: 35px;
            }

            .menu {
                top: 50px;
                right: 15px;
                width: 180px;
            }

            .name-design {
                max-height: 250px; 
                width: 80%; 
            }
        }

        @media only screen and (min-width: 769px) and (max-width: 992px) {
            .container {
                padding: 40px;
            }

            .menu-icon {
                top: 20px;
                right: 20px;
                width: 40px;
            }

            .menu {
                top: 60px;
                right: 20px;
                width: 200px;
            }

            .name-design {
                max-height: 300px; 
                width: 75%; 
            }
        }

        @media only screen and (min-width: 993px) and (max-width: 1200px) {
            .container {
                padding: 50px;
            }

            .menu-icon {
                top: 25px;
                right: 25px;
                width: 50px;
            }

            .menu {
                top: 70px;
                right: 25px;
                width: 220px;
            }

            .name-design {
                max-height: 350px; 
                width: 70%; 
            }
        }

        @media only screen and (min-width: 1201px) {
            .container {
                padding: 60px;
            }

            .menu-icon {
                top: 30px;
                right: 30px;
                width: 60px;
            }

            .menu {
                top: 80px;
                right: 30px;
                width: 240px;
            }

            .name-design {
                max-height: 400px; 
                width: 60%; 
            }
        }
       
        .join-requests {
            text-align: left;
            margin-top: 40px;
            padding: 20px;
            background-color: #385170;
            border-radius: 8px;
            color: #F1F1F2;
        }

        .join-requests h2 {
            margin-bottom: 20px;
        }

        .join-request-details {
            margin-bottom: 20px;
        }

        .join-request-details label {
            font-weight: bold;
        }

        .join-request-details select {
            margin-left: 10px;
            padding: 5px;
            border-radius: 5px;
        }

        .join-request-actions {
            margin-top: 20px;
        }

        .join-request-actions button {
            margin-right: 10px;
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .join-request-actions button:hover {
            background-color: #45a049;
        }

        .join-request-actions button:last-child {
            background-color: #f44336;
        }

        .join-request-actions button:last-child:hover {
            background-color: #d32f2f;
        }

        .join-team {
            margin-top: 40px;
            padding: 20px;
            background-color: #385170;
            border-radius: 8px;
            color: #F1F1F2;
        }

        .join-team h2 {
            margin-bottom: 20px;
        }

        .join-team label {
            font-weight: bold;
        }

        .join-team input[type="text"] {
            margin-bottom: 10px;
            padding: 5px;
            border-radius: 5px;
        }

        .join-team button {
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #F1F1F2;
            cursor: pointer;
            font-family: "Arial Black", Arial, sans-serif; 
        }

        .join-team button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
        <img src="name_design.png" class="name-design" alt="Name Design">
        <img src="icon_menu_static.png" class="menu-icon" onclick="toggleMenu()">
        <div class="menu" id="menu">
            <a href="#">Persone</a>
            <a href="#">Statistiche</a>
            <a href="#">Chat</a>
            <a href="#">Allenamenti</a>
            <a href="#">Calendario</a>
            <a href="#">Pannello di controllo</a>
            <a href="#">Impostazioni</a>
            <a href="logout.php">Logout</a>
        </div>

        <?php
        // Controlla se il giocatore fa parte di una squadra
        if ($is_part_of_team) {
            // Se il giocatore fa parte di una squadra, reindirizza alla home
            header("Location: home_giocatore.php");
            exit();
        } else {
            // Se il giocatore non fa parte di una squadra, mostra la sezione per unirsi a una squadra
            echo "<div class='join-team'>";
            echo "<h2>Unisciti a una squadra</h2>";
            // Form per inviare la richiesta di unione
            echo "<form action='home.php' method='POST'>";
            
            echo "<input type='text' id='team_code' name='cod_squadra' required><br>";
            echo "<button type='submit'>Invia Richiesta</button>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function acceptRequest() {
            alert("Richiesta accettata!");
            // Qui puoi aggiungere il codice per accettare la richiesta
        }

        function rejectRequest() {
            alert("Richiesta rifiutata!");
            // Qui puoi aggiungere il codice per rifiutare la richiesta
        }
    </script>
</body>
</html>