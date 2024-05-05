<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sport Portal Connect</title>
    <link rel="icon" href="coach_icon.png" type="image/x-icon">
    <style>
       
       

       body {
            margin: 0;
            padding: 0;
            font-family: "Arial Black", Arial, sans-serif;
            background-color: #081f37; 
            color: #F1F1F2;
            background-image: url('sfondo.png');
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
        }

        .container {
            width: 90%;
            max-width: 400px;
            margin: 100px auto;
            background-color: rgba(0, 0, 0, 0.9);
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #F1F1F2;
        }

        .container input[type="text"],
        .container input[type="password"] {
            
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #F1F1F2;
            border-radius: 4px;
            outline: none;
            background-color: #F1F1F2;
            color: Black;
            font-family: "Arial Black", Arial, sans-serif;
            font-size: 12px;
        }

        .container button {
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

        .container button:hover {
            background-color: #1995AD;
        }

        .container p {
            margin-top: 15px;
            color: #F1F1F2;
        }

        .container a {
            color:  #5C7485;
            text-decoration: none;
        }

        .container a:hover {
            text-decoration: underline;
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
    <div class="container">
        <h2>LOGIN</h2>
        <form action="login_process.php" method="post">
            <input type="text" name="username" placeholder="Nome utente o Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">ACCEDI</button>
        </form>
    
        <p>Sei un allenatore? <a href="register_coach.php">Registrati qui.</a></p>
        <p>Non hai un account? <a href="register.php">Registrati qui.</a></p>
        
    </div>
  
</body>
</html>