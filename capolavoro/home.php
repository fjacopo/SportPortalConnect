<?php
session_start();

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    // Reindirizzo alla pagina di accesso se l'utente non è autenticato
    header("Location: index.php");
    exit;
}

// Controllo se l'utente ha il ruolo di Allenatore
if ($_SESSION['ruolo'] !== 'Allenatore') {
    
    header("Location: home.php");
    exit;
}

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
            background-color: #121212;
            background-image: url('homeimage.jpg');
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
            color: #F1F1F2;
            position: relative;
        }

        .container {
            width: 90%;
            max-width: 2200px; 
            margin: 20px auto;
            background-color: rgba(30, 84, 159, 1);
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

        .team-code {
            top: 20px;
            left: 20px;
            font-size: 14px;
            color: #f1f1f2;
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
                top: 25px;
                right: 10px;
                width: 100px;
            }

            .name-design {
                max-height: 150px; 
                width: 100%; 
            }
            .team-code {
            font-size: 8px;
            color: #f1f1f2;
          }
          footer {
            font-size: 8px;
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
                top: 33px;
                right: 15px;
                width: 150px;
            }

            .name-design {
                max-height: 200px; 
                width: 90%; 
            }
            .team-code {
            font-size: 9px;
            color: #f1f1f2;
        }
        footer {
            font-size: 8px;
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
                top: 40px;
                right: 20px;
                width: 180px;
            }

            .name-design {
                max-height: 250px; 
                width: 85%; 
            }
        }
        .team-code {
            font-size: 10px;
            color: #f1f1f2;
        }
        footer {
            font-size: 10px;
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
                top: 35px;
                right: 15px;
                width: 180px;
            }

            .name-design {
                max-height: 250px; 
                width: 80%; 
            }
            .team-code {
            font-size: 11px;
            color: #f1f1f2;
          }
          footer {
            font-size: 12px;
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
                top: 45px;
                right: 20px;
                width: 200px;
            }

            .name-design {
                max-height: 300px; 
                width: 75%; 
            }
            .team-code {
            font-size: 12px;
            color: #f1f1f2;
            }
            footer {
            font-size: 14px;
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
                top: 55px;
                right: 25px;
                width: 220px;
            }

            .name-design {
                max-height: 350px; 
                width: 70%; 
            }
            .team-code {
            font-size: 13px;
            color: #f1f1f2;
           }
           footer {
            font-size: 14px;
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
                top: 65px;
                right: 30px;
                width: 240px;
            }

            .name-design {
                max-height: 400px; 
                width: 60%; 
            }
            .team-code {
            font-size: 14px;
            color: #f1f1f2;
        }
         footer {
            font-size: 14px;
          }
        }
       
        .join-requests {
            text-align: left;
            margin-top: 40px;
            padding: 20px;
            background-color: #081f37;
            border-radius: 8px;
            color: #F1F1F2;
            overflow-y: auto; 
            max-height: 200px; 
        }

        .join-requests h2 {
            margin-bottom: 20px;
            font-size:18px;
        }

        .join-request {
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            padding: 10px;
            border-bottom: 1px solid #385170;
        }

        .join-request-details {
            flex: 1; 
            text-align: left;
            display: flex;
            flex-wrap: wrap;
        }

        .join-request-details input,
        .join-request-details select {
            border: none;
            background-color: transparent;
           
            margin-bottom: 10px;
            font-family: "Arial Black", Arial, sans-serif;
            font-size: 15px; 
            color: #F1F1F2;
            width: 240px; 
        }

        .join-request-actions {
            display: flex;
            align-items: center; 
        }

        .join-request-actions button {
            margin-top: 10px;
            margin-left: 5px; 
            padding: 6px 20px;
            border: none;
            border-radius: 5px;
            background-color: #17b794;
            color: #F1F1F2;
            cursor: pointer;
            font-family: "Arial Black", Arial, sans-serif;
        }

        .join-request-actions button:hover {
            background-color: #45a049;
        }

        .join-request-actions button:last-child {
            background-color: #f95959;
        }

        .join-request-actions button:last-child:hover {
            background-color: #d32f2f;
        }

      
        .join-requests::-webkit-scrollbar {
            width: 10px;
        }

        .join-requests::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .join-requests::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 5px;
        }

        .join-requests::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        footer {
            background-color: #1e549f;
            color: #f1f1f2;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0px;
            width: 100%;
            
        }

        footer p {
            margin: 0;
        }
    </style>

</head>
<body>
    <div class="container">
    
      
       <img src="name_design.png" class="name-design" alt="Name Design">
       <img src="icon_menu_static.png" class="menu-icon" onclick="toggleMenu()" id="menu-icon">
        <div class="menu" id="menu">
            <a href="persone.php">Persone</a>
            <a href="#">Chat</a>
            <a href="#">Allenamenti</a>
            <a href="calendario.php">Calendario</a>
            <a href="impostazioni.php">Impostazioni</a>
            <a href="logout.php">Logout</a>
        </div>
        
        <div class="team-code">Codice Squadra: <?php echo $_SESSION['cod_squadra']; ?></div>
        <div class="join-requests">
            <h2>Richieste di unione</h2>
            
            <?php
                  
                  require_once "db_connection.php";
                  
                
                  // Query per recuperare le richieste relative al codice squadra dell'allenatore
                  $sql = "SELECT id, nome, cognome, data_nascita, username, email, ruolo 
                          FROM richieste_giocatori 
                          WHERE cod_squadra = ?";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("s", $_SESSION['cod_squadra']);
                  $stmt->execute();
                  $result = $stmt->get_result();
              
                  // Chiudi la connessione
                  $conn->close();
              
                  if ($result && $result->num_rows > 0) {
                      while ($request = $result->fetch_assoc()) {
                        echo "<div class='join-request'>";
                        echo "<div class='join-request-details'>";
                        echo "<input type='text' value='" . $request['nome'] . "' disabled>";
                        echo "<input type='text' value='" . $request['cognome'] . "' disabled>";
                        echo "<input type='text' value='" . $request['data_nascita'] . "' disabled>";
                        echo "<input type='text' value='" . $request['username'] . "' disabled>";
                        echo "<input type='text' value='" . $request['email'] . "' disabled>";
                        
                        // Aggiungi il campo select per selezionare il ruolo
                        echo "<select name='role_" . $request['id'] . "'>";
                        echo "<option value='preparatore'" . ($request['ruolo'] == 'preparatore' ? ' selected' : '') . ">Preparatore</option>";
                        echo "<option value='giocatore'" . ($request['ruolo'] == 'giocatore' ? ' selected' : '') . ">Giocatore</option>";
                        echo "</select>";
                        
                        echo "</div>";
                        echo "<div class='join-request-actions'>";
                        // Passa l'ID della richiesta e il nome del campo select al pulsante "Accetta"
                        echo "<button onclick='acceptRequest(" . $request['id'] . ", \"role_" . $request['id'] . "\")'>Accetta</button>";
                        echo "<button onclick='rejectRequest(" . $request['id'] . ")'>Rifiuta</button>";
                        echo "</div>";
                        echo "</div>";
                      }
                  } else {
                      echo "<p>Nessuna richiesta di unione trovata.</p>";
                  }
            ?>
        </div>
    </div>

</div>
    
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function acceptRequest(id, roleSelectId) {
    // Recupera il valore selezionato dal campo select
    var roleSelect = document.getElementsByName(roleSelectId)[0];
    var selectedRole = roleSelect.options[roleSelect.selectedIndex].value;

    // Effettua una richiesta AJAX per accettare la richiesta nel database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "accetta_richiesta.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            // Se l'operazione è completata con successo, ricarica la pagina per aggiornare l'elenco delle richieste
            if (response === "success") {
                location.reload();
            } else {
                // Se c'è stato un errore, mostra un messaggio di errore
                alert("Si è verificato un errore durante l'elaborazione della richiesta.");
            }
        }
    };
    // Invia l'ID della richiesta e il ruolo selezionato come parametri POST
    xhr.send("request_id=" + id + "&selected_role=" + selectedRole);
}

    // Funzione per gestire il rifiuto di una richiesta
    function rejectRequest(id) {
        // Effettua una richiesta AJAX per rifiutare la richiesta nel database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "rifiuta_richiesta.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Se l'operazione è completata con successo, ricarica la pagina per aggiornare l'elenco delle richieste
                location.reload();
            }
        };
        xhr.send("request_id=" + id);
    }
     
    </script>

    <footer>
        <p>&copy; 2024 Sport Portal Connect. Tutti i diritti riservati.</p>
    </footer>
</body>
</html>