<?php
session_start();

// Verifica se l'utente è autenticato e se ha un ruolo definito nella sessione
if (!isset($_SESSION['username']) || !isset($_SESSION['ruolo'])) {
    // Reindirizza l'utente alla pagina di accesso se non è autenticato
    header("Location: index.php");
    exit();
}

$userRole = $_SESSION['ruolo']; // Ottieni il ruolo dell'utente dalla sessione
$cod_squadra = $_SESSION['cod_squadra'];
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
            margin-top: 40px;
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
            text-align:center;
            width: 230px;
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
        #eventForm, #editEventForm {
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

        #eventForm label, #editEventForm label {
            display: block;
            margin-bottom: 10px;
        }

        #eventForm input[type="text"],
        #eventForm input[type="datetime-local"],
        #eventForm input[type="submit"],
        #eventForm button,
        #editEventForm input[type="text"],
        #editEventForm input[type="datetime-local"],
        #editEventForm input[type="submit"],
        #editEventForm button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: "Arial Black", Arial, sans-serif;
        }

        #eventForm input[type="submit"],
        #eventForm button,
        #editEventForm input[type="submit"],
        #editEventForm button {
            background-color: #1e549f;
            color: #f1f1f2;
            cursor: pointer;
        }

        #eventForm input[type="submit"]:hover,
        #editEventForm input[type="submit"]:hover,
        #eventForm button:hover{
            background-color: #5fc9f3;
        }
        #cancelEdit:hover {
            background-color: #5fc9f3;
        }
        #deleteEvent:hover {
            background-color: #f95959;
        }

        
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
       
        @media (max-width: 300px) {
            #calendar {
                width: auto;
                padding: 10px;
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

        }

        @media (min-width: 301px) and (max-width: 480px) {
            #calendar {
                width: auto;
                padding: 10px;
            }

            .fc-toolbar.fc-header-toolbar {
                display: block;
            }

            .fc-view-container {
                width: 100%;
            }

            .fc-view.fc-view-agendaWeek {
                display: none;
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
            #calendar {
                width: auto;
                padding: 10px;
            }

            .fc-toolbar.fc-header-toolbar {
                display: block;
            }

            .fc-view-container {
                width: 100%;
            }

            .fc-view.fc-view-agendaWeek {
                display: none;
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
            #calendar {
                width: auto;
                padding: 10px;
            }

            .fc-toolbar.fc-header-toolbar {
                display: block;
            }

            .fc-view-container {
                width: 100%;
            }

            .fc-view.fc-view-agendaWeek {
                display: none;
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
            #calendar {
                width: auto;
                padding: 10px;
            }

            .fc-toolbar.fc-header-toolbar {
                display: block;
            }

            .fc-view-container {
                width: 100%;
            }

            .fc-view.fc-view-agendaWeek {
                display: none;
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
            #calendar {
                width: auto;
                
                padding: 10px;
            }

            .fc-toolbar.fc-header-toolbar {
                display: block;
            }

            .fc-view-container {
                width: 100%;
            }

            .fc-view.fc-view-agendaWeek {
                display: none;
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

     
        @media only screen and (min-width: 1201px) {
            #calendar {
                width: 850px; 
                padding: 20px;
            }

            .fc-view.fc-view-agendaWeek {
                display: block;
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

<div id="editEventForm">
    <label for="editTitle">Titolo:</label>
    <input type="text" id="editTitle" name="editTitle">
    
    <label for="editStartDate">Data e ora di inizio:</label>
    <input type="datetime-local" id="editStartDate" name="editStartDate">
    
    <label for="editEndDate">Data e ora di fine:</label>
    <input type="datetime-local" id="editEndDate" name="editEndDate">
    
    <label for="editLocation">Luogo:</label>
    <input type="text" id="editLocation" name="editLocation">
    
    <input type="submit" id="saveEdit" value="Salva Modifiche">
    <button type="button" id="cancelEdit">Annulla</button> 
    <button type="button" id="deleteEvent">Elimina</button>
</div>

<div class = "container"  > 
<img src="icon_menu_static.png" class="menu-icon" onclick="toggleMenu()" id="menu-icon">
<div class="menu" id="menu">
    <?php if ($userRole === "Allenatore"): ?>
        <a href="home.php">Home</a>
        <a href="persone.php">Persone</a>
        <a href="#">Chat</a>
        <a href="#">Allenamenti</a>
        <a href="impostazioni.php">Impostazioni</a>
    <?php else: ?>
        <a href="home_giocatore.php">Home</a>
        <a href="persone.php">Persone</a>
        <a href="#">Chat</a>
        <a href="#">Allenamenti</a>
        <a href="impostazioni.php">Impostazioni</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</div>


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

        var selectedEventId; // Variabile per tenere traccia dell'evento selezionato
        

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
                selectedEventId = event.id;
                $('#editTitle').val(event.title);
                $('#editStartDate').val(event.start.format('YYYY-MM-DDTHH:mm')); 
                $('#editEndDate').val(event.end.format('YYYY-MM-DDTHH:mm')); 
                $('#editLocation').val(event.location);

                <?php if ($userRole === "Allenatore"): ?>
                    $('#editEventForm').show();
                <?php else: ?>
                    $('#editEventForm').show();
                    $('#cancelEdit').text('Esci');
                    $('#saveEdit').hide();
                    $('#deleteEvent').hide();
                  
                <?php endif; ?>
            }
            
        });

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
                alert('Aggiungi un titolo');
                return;
            }
            if (startTime.trim() === '') {
                alert('Aggiungi una data di inizio');
                return;
            }
            if (endTime.trim() === '') {
                alert('Aggiungi una data di fine');
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
            $('#editEventForm').show();
        });

        $('#saveEdit').on('click', function () {
            var title = $('#editTitle').val();
            var startTime = $('#editStartDate').val();
            var endTime = $('#editEndDate').val();
            var location = $('#editLocation').val();

            if (title.trim() === '') {
                alert('Aggiungi un titolo');
                return;
            }
            if (startTime.trim() === '') {
                alert('Aggiungi una data di inizio');
                return;
            }
            if (endTime.trim() === '') {
                alert('Aggiungi una data di fine');
                return;
            }

            // Aggiorna l'evento nel calendario
            var eventToUpdate = $('#calendar').fullCalendar('clientEvents', selectedEventId)[0];
            eventToUpdate.title = title;
            eventToUpdate.start = startTime;
            eventToUpdate.end = endTime;
            eventToUpdate.location = location;
            $('#calendar').fullCalendar('updateEvent', eventToUpdate);

            $.ajax({
                 url: 'edit-event.php',
                type: 'POST',
                data: {
                id: selectedEventId,
                title: title,
                start: startTime,
                end: endTime,
                location: location
                },
             success: function (response) {
            // Gestisci la risposta dal server se necessario
            console.log(response);
             },
             error: function (xhr, status, error) {
            // Gestisci gli errori se necessario
            console.error(error);
            }
        });

            // Nascondi il form di modifica
            $('#editEventForm').hide();
        });

        $('#cancelEdit').on('click', function () {
            $('#editEventForm').hide();
        });

        $('#deleteEvent').on('click', function () {
            var confirmDelete = confirm("Sei sicuro di voler eliminare questo evento?");
            if (confirmDelete) {
                $.ajax({
                    url: 'delete-event.php',
                    type: 'POST',
                    data: {
                        id: selectedEventId
                    },
                    success: function (response) {
                        displayMessage(response);
                        $('#calendar').fullCalendar('refetchEvents');
                        $('#editEventForm').hide();
                    },
                    error: function (xhr, status, error) {
                        displayMessage("Errore nell'eliminazione dell'evento: " + error);
                    }
                });
            }
        });

        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setTimeout(function () { $(".success").fadeOut(); }, 1000);
        }
    });
</script>
</body>

</html>
