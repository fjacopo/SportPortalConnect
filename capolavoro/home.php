<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Arial Black", Arial, sans-serif;
            background-color: #1995AD;
            color: white;
        }

        .container {
            width: 90%;
            max-width: 2000px; /* Larghezza massima del container */
            margin: 40px auto; /* Spazio tra il container e il bordo superiore */
            background-color: #89ABE3;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            position: relative; /* Aggiunto il posizionamento relativo per il green-dot */
        }

        .green-dot {
            width: 20px;
            height: 20px;
            background-color: #0f0;
            border-radius: 50%;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #F1F1F2;
        }

        .container p {
            margin-top: 15px;
            color: #F1F1F2;
        }

        .container a {
            color: #5C7485;
            text-decoration: none;
        }

        .container a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 600px) {
            .container {
                width: 90%; /* Riduci la larghezza del container al 90% quando la larghezza dello schermo è inferiore a 600px */
                max-width: none; /* Rimuovi la larghezza massima quando la larghezza dello schermo è inferiore a 600px */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="green-dot"></div>
        <h2>Benvenuto in SportPortalConnect</h2>
        <p>"Crea connessioni, raggiungi traguardi. SportPortalConnect: il tuo collegamento al successo sportivo!".</p>
        <a href="logout.php" class="logout-btn">Logout</a> 
    </div>
</body>
</html>
