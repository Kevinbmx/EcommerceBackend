
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>cancelar pedido</title>
    <style type="text/css">
        body{
            color: black !important;
            font-family: Roboto,sans-serif;
            line-height: 1.5;
        }
        .pedidos{
            border-radius: 2%;
            padding: 15px;
            margin: 0 auto;
            width:550px;
            background-color: #FAFAFA;
        }
        a{
            text-decoration:none;
        }
    </style>
</head>
<body>
    <div class="pedidos">
        <h2 style="text-align: center;">Niño Tienda</h2>
        <p>Has cancelado tu pedido # {{$pedidoCancelado->id}} .</p>
        <p>Motivo de cancelar pedido:</p>
        <p> {{$pedidoCancelado->motivo_anulacion}} </p>
        <div style="text-align: center;">
            <a class="fab fa-facebook-f" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
            <a class="fab fa-whatsapp" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
            <a class="far fa-envelope" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
            <a class="fas fa-directions" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
        </div>
    </div>
</body>
</html>
