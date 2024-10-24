<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | JHARDSYSTEX</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="content-image">
        <img src="https://i.ibb.co/StjsvX2/jhardsystex.jpg" alt="Logo">
    </div>
    <div class="wrapper">
        <form action="./index.php" method="POST">
            <h1>Iniciar sesión</h1>
            <div class="input-box">
                <input type="text"  name="usuario" placeholder="Usuario" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pass" placeholder="Contraseña" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn">Comencemos</button>
        </form>
    </div>
</body>
</html>