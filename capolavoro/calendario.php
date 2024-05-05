<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <title>Calendario - Sport Portal Connect</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>
    <script src="fullcalendar/locale/it.js"></script> <!-- File di lingua italiana -->

    <script>
        $(document).ready(function () {
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

                editable: true,
                events: "fetch-event.php",
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    // Mostra il form per l'aggiunta dell'evento
                    $('#eventForm').show(); 

                    // Imposta la data di inizio nel campo nascosto startDate
                    $('#startDate').val(moment(start).formatDate('YYYY-MM-DD HH'));

                    // Imposta la data di fine nel campo nascosto endDate
                    $('#endDate').val(moment(end).formatDate('YYYY-MM-DD H'));
                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
                eventClick: function (event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: "delete-event.php",
                            data: "&id=" + event.id,
                            success: function (response) {
                                if (parseInt(response) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    displayMessage("Deleted Successfully");
                                }
                            }
                        });
                    }
                }
            });

            // Funzione per mostrare un messaggio di successo temporaneo
            function displayMessage(message) {
                $(".response").html("<div class='success'>" + message + "</div>");
                setInterval(function () { $(".success").fadeOut(); }, 1000);
            }

            // Gestione del form per l'aggiunta di eventi
            $('#cancelEvent').on('click', function () {
                $('#eventForm').hide(); // Nasconde il form al clic
                $('#title').val(''); // Resetta i valori del form
                $('#startTime').val('');
                $('#endTime').val('');
                $('#location').val('');
            });

            $('#submitEvent').on('click', function () {
                var title = $('#title').val();
                var startTime = $('#startTime').val();
                var endTime = $('#endTime').val();
                var location = $('#location').val();

                // Verifica che il titolo sia inserito
                if (title.trim() === '') {
                    alert('Il titolo è obbligatorio!');
                    return;
                }

                // Verifica che le ore di inizio e fine siano inserite
                if (startTime.trim() === '' || endTime.trim() === '') {
                    alert('Inserisci l\'ora di inizio e l\'ora di fine!');
                    return;
                }

                // Esegui la richiesta AJAX per aggiungere l'evento al database
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
                        // Mostra un messaggio di successo
                        displayMessage(response);
                        // Aggiorna il calendario
                        $('#calendar').fullCalendar('refetchEvents');
                    },
                    error: function (xhr, status, error) {
                        // Mostra un messaggio di errore in caso di problemi
                        displayMessage("Errore nell'aggiunta dell'evento: " + error);
                    }
                });

                // Chiudi il form e resetta i campi
                $('#eventForm').hide();
                $('#title').val('');
                $('#startTime').val('');
                $('#endTime').val('');
                $('#location').val('');
            });
        });
    </script>

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
            margin-top: 33px;
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
        #eventForm input[type="time"],
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

        #eventForm input[type="submit"]:hover{
            background-color: #5fc9f3;
        }

        #eventForm button:hover{
            background-color: #f95959;
        }
    </style>
</head>

<body>
    <header>
        <h1>Calendario</h1>
    </header>
    <div id='calendar'></div>
  
    <div id="eventForm">
    <label for="title">Titolo:</label>
    <input type="text" id="title" name="title">


    <label for="startTime">Ora di inizio:</label>
    <input type="time" id="startTime" name="startTime">
    
 
    <label for="endTime">Ora di fine:</label>
    <input type="time" id="endTime" name="endTime">

    <label for="location">Luogo:</label>
    <input type="text" id="location" name="location">
    <input type="submit" id="submitEvent" value="Aggiungi Evento">
    <button type="button" id="cancelEvent">Annulla</button> 
</div>

    <img src="icon_menu_static.png" class="menu-icon" onclick="toggleMenu()" id="menu-icon">
    <div class="menu" id="menu">
        <a href="home.php">Home</a>
        <a href="#">Persone</a>
        <a href="#">Statistiche</a>
        <a href="#">Chat</a>
        <a href="#">Allenamenti</a>
        <a href="impostazioni.php">Impostazioni</a>
        <a href="logout.php">Logout</a>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>

    <footer>
        <p>&copy; 2024 Sport Portal Connect. Tutti i diritti riservati.</p>
    </footer>
</body>

</html>
