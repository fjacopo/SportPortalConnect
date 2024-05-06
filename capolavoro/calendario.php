<?php
session_start();

// Verifica se l'utente è autenticato e se ha un ruolo definito nella sessione
if (!isset($_SESSION['username']) || !isset($_SESSION['ruolo'])) {
    // Reindirizza l'utente alla pagina di accesso se non è autenticato
    header("Location: index.php");
    exit();
}

$userRole = $_SESSION['ruolo']; // Ottieni il ruolo dell'utente dalla sessione
?>

<!DOCTYPE html>
<html>

<head>
    <title>Calendario - Sport Portal Connect</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Arial Black", Arial, sans-serif;
            background-color: #121212;
            color: #F1F1F2;
            position: relative;
        }

        #calendar {
            width: 855px;
            height: 30%;
            margin: 0 auto;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            position: relative;
            margin-top: 15px;
            color: #f1f1f2;
        }

        #calendar .fc-today {
            background-color: #1e549f;
            color: #f1f1f2;
        }

        .success {
            background: #cdf3cd;
            padding: 10px 20px;
            border: #c3e6c3 1px solid;
            display: inline-block;
            border-radius: 4px;
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

        header {
            background-color: #1e549f;
            color: #f1f1f2;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin-top: 0;
            font-size: 25px;
            font-weight: normal;
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

        /* Stile per il form di aggiunta evento */
        #eventForm {
            display: none;
            position: absolute;
            top: 200px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f1f1f2;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            color: #333;
        }

        #eventForm label {
            display: block;
            margin-bottom: 10px;
        }

        #eventForm input[type="text"],
        #eventForm input[type="datetime-local"],
        #eventForm input[type="submit"],
        #eventForm button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: "Arial Black", Arial, sans-serif;
        }

        #eventForm input[type="submit"],
        #eventForm button {
            background-color: #1e549f;
            color: #f1f1f2;
            cursor: pointer;
        }

        #eventForm input[type="submit"]:hover {
            background-color: #5fc9f3;
        }

        #eventForm button:hover {
            background-color: #f95959;
        }
        
        

        /* Stile dei bottoni simile al codice dell'eliminazione dell'account */
        #buttonGroup button {
            background-color: #1e549f;
            color: #f1f1f2;
            padding: 5px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Arial Black", Arial, sans-serif;
            margin-right: 10px;
            font-size: 15px;
            margin-top: 10px;
        }

        #buttonGroup button:hover {
            background-color: #174280;
        }

        #buttonGroup button:last-child {
            margin-right: 0;
        }
        

    </style>
</head>

<body>
    <header>
        <h1>Calendario</h1>
    </header>
    <div id='calendar'>
    <div id="buttonGroup">
        <button id="aggiungiButton">Aggiungi</button>
        <button id="modificaButton">Modifica</button>
    </div>
    </div>
    <div id="eventForm">
        <label for="title">Titolo:</label>
        <input type="text" id="title" name="title">
    
        <label for="startDate">Data e ora di inizio:</label>
        <input type="datetime-local" id="startDate" name="startDate">
        
        <label for="endDate">Data e ora di fine:</label>
        <input type="datetime-local" id="endDate" name="endDate">
    
        <label for="location">Luogo:</label>
        <input type="text" id="location" name="location">
        <input type="submit" id="submitEvent" value="Aggiungi Evento">
        <button type="button" id="cancelEvent">Annulla</button> 
    </div>

    <img src="icon_menu_static.png" class="menu-icon" onclick="toggleMenu()" id="menu-icon">
    <div class="menu" id="menu">
    <?php if ($userRole === "Allenatore"): ?>
        <a href="home.php">Home</a>
        <a href="#">Persone</a>
        <a href="#">Statistiche</a>
        <a href="#">Chat</a>
        <a href="#">Allenamenti</a>
        <a href="impostazioni.php">Impostazioni</a>
    <?php else: ?>
        <a href="home_giocatore.php">Home</a>
        <a href="#">Persone</a>
        <a href="#">Statistiche</a>
        <a href="#">Chat</a>
        <a href="#">Allenamenti</a>
        <a href="impostazioni.php">Impostazioni</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</div>

    <footer>
        <p>&copy; 2024 Sport Portal Connect. Tutti i diritti riservati.</p>
    </footer>
    <script>
          function toggleMenu() {
                var menu = document.getElementById("menu");
                menu.style.display = menu.style.display === "block" ? "none" : "block";
            }
    </script>

    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>
    <script src="fullcalendar/locale/it.js"></script>
    <script>
        $(document).ready(function () {
            var userRole = "<?php echo $userRole; ?>";

            function toggleButtonsByRole(role) {
                if (role === "Allenatore") {
                    $('#aggiungiButton').show();
                    $('#modificaButton').show();
                } else {
                    $('#aggiungiButton').hide();
                    $('#modificaButton').hide();
                }
            }

            toggleButtonsByRole(userRole);

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'Oggi',
                    month: 'Mese',
                    week: 'Settimana',
                    day: 'Giorno'
                },
                editable: false,
                events: "fetch-event.php",
                displayEventTime: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true' || event.allDay === true) {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: false,
                selectHelper: false,
                select: function (start, end, allDay) {
                    $('#startDate').val(moment(start).format('YYYY-MM-DDTHH:mm'));
                    $('#endDate').val(moment(end).format('YYYY-MM-DDTHH:mm'));
                    $('#eventForm').show();
                },
                eventClick: function (event) {
                    var deleteMsg = confirm("Vuoi davvero eliminare l'evento?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: "delete-event.php",
                            data: "id=" + event.id,
                            success: function (response) {
                                if (parseInt(response) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    displayMessage("Evento eliminato con successo");
                                }
                            }
                        });
                    }
                }
            });

            function displayMessage(message) {
                $(".response").html("<div class='success'>" + message + "</div>");
                setTimeout(function () { $(".success").fadeOut(); }, 1000);
            }

            $('#cancelEvent').on('click', function () {
                $('#eventForm').hide();
                $('#title').val('');
                $('#startDate').val('');
                $('#endDate').val('');
                $('#location').val('');
            });

            $('#submitEvent').on('click', function () {
                var title = $('#title').val();
                var startTime = $('#startDate').val();
                var endTime = $('#endDate').val();
                var location = $('#location').val();

                if (title.trim() === '') {
                    alert('Il titolo è obbligatorio!');
                    return;
                }

                $.ajax({
                    url: 'add-event.php',
                    type: 'POST',
                    data: {
                        title: title,
                        start: startTime,
                        end: endTime,
                        location: location
                    },
                    success: function (response) {
                        displayMessage(response);
                        $('#calendar').fullCalendar('refetchEvents');
                    },
                    error: function (xhr, status, error) {
                        displayMessage("Errore nell'aggiunta dell'evento: " + error);
                    }
                });

                $('#eventForm').hide();
                $('#title').val('');
                $('#startDate').val('');
                $('#endDate').val('');
                $('#location').val('');
            });

            $('#aggiungiButton').on('click', function () {
                $('#eventForm').show();
            });

            $('#modificaButton').on('click', function () {
                // Implementa la logica per la modifica degli eventi
            });

        });
    </script>
</body>

</html>
