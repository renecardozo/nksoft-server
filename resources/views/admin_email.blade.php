<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333333;
        }
        .title{
            font-family: Arial, sans-serif;
            color: #585d6a !important;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dddddd;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3 class="title">{{ $title }}</h3>
        </div>
        <div class="content">
            <p><strong>Razón de la Solicitud:</strong> {{ $razon_solicitud }}</p>
            <p><strong>Ambiente:</strong> {{ $ambiente }}</p>
            <p><strong>Materia:</strong> {{ $materia }}</p>
            <p><strong>Fecha:</strong> {{ $fecha }}</p>
            <p><strong>Estado de Solicitud:</strong> {{ $estado_de_solicitud }}</p>
            <p>{!! $content !!}</p>
        </div>
    </div>
</body>
</html>
