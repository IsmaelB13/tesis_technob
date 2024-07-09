<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .page-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
            border: 2px solid #28a745; /* Borde verde */
        }

        .form-container h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-container .btn {
            display: inline-block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .form-container .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content" style="background-color: #ffffff;">
        <div class="form-container" style="background-color: #ffffff;">
            <h1>Enviar correo: {{$data->name}}</h1>
            <form action="{{url('mail_conductor', $data->id)}}" method="POST">
                @csrf
                <div>
                    <label>Saludo</label>
                    <input type="text" name="greeting" maxlength="20" pattern="[A-Za-z\s]{1,20}" title="Solo se permiten letras y espacios, hasta 20 caracteres.">
                </div>
                
                <div>
                    <label>Cuerpo del correo</label>
                    <textarea name="body" maxlength="120" pattern="[A-Za-z\s]{1,20}" title="Solo se permiten letras y espacios, hasta 120 caracteres."></textarea>
                </div>
               
                
                <div>
                    <label>Pie del Correo</label>
                    <input type="text" name="endline"  maxlength="20" pattern="[A-Za-z\s]{1,20}" title="Solo se permiten letras y espacios, hasta 20 caracteres.">
                </div>
                <div>
                    <input class="btn" type="submit" value="Enviar Correo">
                </div>
            </form>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
