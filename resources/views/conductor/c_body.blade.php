<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .page-header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
        .page-header h2 {
            margin: 0;
        }
        .welcome-section {
            position: relative;
            width: 100%;
            height: calc(100vh - 70px); /* Ajusta la altura de la sección según el tamaño del header */
            background: url('images/banner3.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Ajusta la opacidad según sea necesario */
            z-index: 1;
        }
        .welcome-message {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        .welcome-message h1 {
            margin: 0;
            font-size: 3em;
        }
        .welcome-message p {
            margin: 20px 0;
            font-size: 1.2em;
        }
        .welcome-message .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .welcome-message .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Dashboard Conductor</h2>
            </div>
        </div>
        <section class="welcome-section">
            <div class="welcome-message">
                <h1>Bienvenido Conductor a nuestra página</h1>
                <p>Estamos encantados de tenerte aquí <br> A continuación, encontrarás información relevante.</p>
            </div>
        </section>
    </div>
</body>
</html>
