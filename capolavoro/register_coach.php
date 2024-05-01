<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Allenatore</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    
    <style>
     
        .error {
            color: red;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Arial Black", Arial, sans-serif;
            background-color:  #081f37; 
            color: white;
            background-image: url('sfondo.png');
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
        }

        .register-container {
            width: 90%;
            max-width: 400px;
            margin: 100px auto;
            background-color: rgba(0, 0, 0, 0.9);
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
            color:  #F1F1F2;
        }

        .register-container form {
            display: grid;
            grid-gap: 10px;
            text-align: left;
        }

        .register-container label {
            font-weight: bold;
        }

        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"],
        .register-container input[type="date"],
        .register-container select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #F1F1F2;
            border-radius: 4px;
            outline: none;
            color: Black;
        }

        .register-container select {
            width: 100%;
        }

        .register-container button {
            font-family: "Arial Black", Arial, sans-serif;
            width: 100%;
            padding: 10px;
            background-color: #5C7485;
            color: #F1F1F2;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .register-container button:hover {
            background-color: #1995AD;
        }

        .register-container a {
            color:  #5C7485;
            text-decoration: none;
        }

        .register-container a:hover {
            text-decoration: underline;
        }

        .register-container p {
            margin-top: 15px;
            color:  #F1F1F2;
        }

        @media screen and (max-width: 480px) {
            .container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>REGISTRAZIONE ALLENATORE</h2>
        <form action="register_coach_process.php" method="post">
          
            <input type="text" id="nome" name="nome" pattern="[A-Za-z]+" placeholder="Nome" required>
            
            <input type="text" id="cognome" name="cognome" pattern="[A-Za-z]+" placeholder="Cognome" required>
           
            <input type="date" id="data_nascita" name="data_nascita" required>
            
            <input type="email" id="email" name="email" placeholder="Email" required>
           
            <input type="text" id="username" name="username" placeholder="Nome Utente" required>
            
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Conferma Password" required>
            <span id="passwordError" class="error"></span>

            <button type="submit" id="registerButton">REGISTRATI</button>
        </form>
        <p>Non sei un allenatore? <a href="register.php">Registrati qui.</a></p>
        <p>Hai già un account? <a href="index.php">Accedi qui.</a></p>
       
    </div>
    <script>

       // Calcola la data massima (5 anni prima rispetto ad oggi)
       var today = new Date();
        var maxDate = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());

        // Formatta la data massima come stringa per l'attributo "max" dell'input date
        var maxDateFormatted = maxDate.toISOString().split('T')[0];

        // Imposta la data massima per l'input date
        document.getElementById('data_nascita').setAttribute('max', maxDateFormatted);

        var today = new Date();
        var minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());

        // Formatta la data minima come stringa per l'attributo "min" dell'input date
        var minDateFormatted = minDate.toISOString().split('T')[0];

        // Imposta la data minima per l'input date
        document.getElementById('data_nascita').setAttribute('min', minDateFormatted);


        const passwordField = document.getElementById("password");
        const confirmPasswordField = document.getElementById("confirm_password");
        const passwordError = document.getElementById("passwordError");
        const registerButton = document.getElementById("registerButton");

        confirmPasswordField.addEventListener("input", function() {
            if (passwordField.value !== confirmPasswordField.value) {
                confirmPasswordField.style.borderColor = "red";
                passwordError.textContent = "Le password non coincidono";
                registerButton.disabled = true;
            } else {
                confirmPasswordField.style.borderColor = "";
                passwordError.textContent = "";
                registerButton.disabled = false;
            }
        });
    </script>
</body>
</html>

