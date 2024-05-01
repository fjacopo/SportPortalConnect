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
            background-color: rgba(56, 81, 112, 0.9);
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

        <div class="join-requests">
            <h2>Richieste di unione</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function acceptRequest() {
            alert("Richiesta accettata!");
            // Quando l'allenatore accetta la richiesta
            // Esegui un'operazione simile a questa per aggiornare lo stato della richiesta
            $update_stmt = $conn->prepare("UPDATE richieste_giocatori SET stato = TRUE WHERE id = ?");
            $update_stmt->bind_param("i", $id_della_richiesta_da_accettare);
            $update_stmt->execute();
        }

            // Dopo aver aggiornato lo stato della richiesta, reindirizza l'utente a home_giocatore.php solo se la richiesta è stata accettata
            if ($update_stmt->affected_rows > 0) {
            header("Location: home_giocatore.php");
            exit();
        }

        function rejectRequest() {
            alert("Richiesta rifiutata!");
            // Qui puoi aggiungere il codice per rifiutare la richiesta
        }
    </script>

    
 <?php
    $servername = "localhost";
    $username = "jacopo";
    $password = "Dianaidra24?";
    $dbname = "sport_portal_db";

    // Crea una connessione
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Query per recuperare le richieste
    $sql = "SELECT id, nome, cognome, data_nascita, username, email, ruolo FROM richieste_giocatori";
    $result = $conn->query($sql);

    // Chiudi la connessione
    $conn->close();

    if ($result && $result->num_rows > 0) {
        while ($request = $result->fetch_assoc()) {
            echo "<div class='join-request-details'>";
             echo "<input type='text' value='" . $request['nome'] . "' disabled>";
             echo "<input type='text' value='" . $request['cognome'] . "' disabled>";
             echo "<input type='text' value='" . $request['data_nascita'] . "' disabled>";
             echo "<input type='text' value='" . $request['username'] . "' disabled>";
             echo "<input type='text' value='" . $request['email'] . "' disabled>";
            echo "<select name='role[]'>";
             echo "<option value='preparatore' " . ($request['ruolo'] == 'preparatore' ? 'selected' : '') . ">Preparatore</option>";
             echo "<option value='giocatore' " . ($request['ruolo'] == 'giocatore' ? 'selected' : '') . ">Giocatore</option>";
            echo "</select>";
            echo "</div>";
            echo "<div class='join-request-actions'>";
             echo "<button onclick='acceptRequest(" . $request['id'] . ")'>Accetta</button>";
             echo "<button onclick='rejectRequest(" . $request['id'] . ")'>Rifiuta</button>";
            echo "</div>";
        }
    } else {
        echo "<p>Nessuna richiesta di unione trovata.</p>";
    }
?>
                
</body>
</html>
