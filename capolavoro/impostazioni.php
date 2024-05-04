<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impostazioni - Sport Portal Connect</title>
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
        }

        @media (min-width: 481px) and (max-width: 600px) {
            .container {
                width: 60%;
            }
        }

        @media only screen and (min-width: 601px) and (max-width: 768px) {
            .container {
                width: 50%;
            }
        }

        @media only screen and (min-width: 769px) and (max-width: 992px) {
            .container {
                width: 50%;
            }
        }

        @media only screen and (min-width: 993px) and (max-width: 1200px) {
            .container {
                width: 50%;
            }
        }

        @media only screen and (min-width: 1201px) {
            .container {
                width: 50%;
            }
        }

        
    </style>
</head>
<body>
    <header>
        <h1>Impostazioni</h1>
    </header>

    <div class="container">
    <img src="icon_menu_static.png" class="menu-icon" onclick="toggleMenu()" id="menu-icon">
        <div class="menu" id="menu">
            <a href="home.php">Home</a>
            <a href="#">Persone</a>
            <a href="#">Statistiche</a>
            <a href="#">Chat</a>
            <a href="#">Allenamenti</a>
            <a href="#">Calendario</a>
            <a href="logout.php">Logout</a>
        </div>
        <form action="aggiorna_impostazioni.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" disabled>

            <label for="current_password">Password Corrente</label>
            <input type="password" id="current_password" name="current_password">

            <label for="new_password">Nuova Password</label>
            <input type="password" id="new_password" name="new_password">

            <label for="confirm_password">Conferma Nuova Password</label>
            <input type="password" id="confirm_password" name="confirm_password">
            
    
            <button type="submit">Salva Modifiche</button>
        </form>

        <!-- Sezione per la gestione dell'account -->
        <section>
            <h2>Gestione Account</h2>
            <ul>
                <li><a href="delete_account.php">Elimina Account</a></li>
            </ul>
        </section>
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
