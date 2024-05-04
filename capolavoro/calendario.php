<?php
session_start();

// Controllo se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    // Reindirizzo alla pagina di accesso se l'utente non è autenticato
    header("Location: index.php");
    exit;
}

// Simulazione di recupero degli eventi dal database o da altre fonti dati
$events = array(
    array(
        'title' => 'Allenamento',
        'start' => '2024-05-01T09:00:00',
        'end' => '2024-05-01T11:00:00',
        'backgroundColor' => '#4caf50'
    ),
    array(
        'title' => 'Partita',
        'start' => '2024-05-08T14:00:00',
        'end' => '2024-05-08T16:00:00',
        'backgroundColor' => '#2196f3'
    )
);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario - Sport Portal Connect</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    <!-- Includi le librerie FullCalendar -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <style>
        /* Stili CSS per FullCalendar */
        body {
            margin: 0;
            padding: 0;
            font-family: "Arial Black", Arial, sans-serif;
            background-color: #121212;
            color: #F1F1F2;
            position: relative;
        }

        header {
            background-color: #1e549f;
            color: #F1F1F2;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        header p {
            margin: 5px 0 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #1e549f;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        #calendar {
            max-width: 600px;
            margin: 0 auto;
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
    <header>
        <h1>Calendario</h1>
        <p>Visualizza gli allenamenti e le partite della squadra</p>
    </header>

    <div class="container">
        <!-- Contenuto del calendario -->
        <div id="calendar"></div>
    </div>

    <footer>
        <p>&copy; 2024 Squadra di Calcio. Tutti i diritti riservati.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Opzioni di FullCalendar
                initialView: 'dayGridMonth', // Visualizza il calendario come griglia mensile
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    // Aggiungi qui gli eventi recuperati dal database o da altre fonti dati
                    <?php foreach ($events as $event): ?>
                        {
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $event['start']; ?>',
                            end: '<?php echo $event['end']; ?>',
                            backgroundColor: '<?php echo $event['backgroundColor']; ?>'
                        },
                    <?php endforeach; ?>
                ],
                eventClick: function(info) {
                    // Gestisce il clic sugli eventi (puoi personalizzarlo come preferisci)
                    alert('Evento: ' + info.event.title + '\nData: ' + info.event.start.toLocaleString());
                },
                select: function(info) {
                    // Gestisce la selezione di un intervallo di tempo (puoi mostrare un form per aggiungere un nuovo evento)
                    // Esempio: $('#exampleModal').modal('show');
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
