<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Document</title>
    <style type="text/css">
      .pedidos{
            border-radius: 2%;
            padding: 15px;
            margin: 0 auto;
            width:550px;
            background-color: #FAFAFA;
        }
        body{
            color: black !important;
            font-family: Roboto,sans-serif;
            line-height: 1.5;
        }
        .cabecera{
            border-radius: 2%;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.12);
        }
        .size-cabecera{
            width: 50%;
        }
        .flexible{
            display: flex;
        }
        .margin-inter-div{
            margin: 10px 0;
        }
        label{
            font-weight: 500;
        }
        p{
            margin: 0px;
        }
        .bordes{
            border-style: solid;
            border-width: 1px;
            border-radius: 2%;
            border-color: gainsboro;
        }
        img {
            height: 90px;
        }
        .redondear-candidad{
            border-radius: 10px;
            background-color: #4caf50!important;
            border-color: #4caf50!important;
            color: #fff;
            font-size: 12px;
            padding: 4px 7px;
        }
        a{
            text-decoration:none;
        }

    </style>
</head>
<body>
    <div class="pedidos">
        <h2 style="text-align: center;">Niño Tienda</h2>
        <h3>Tu pedido es:</h3>
        <div class="bordes">
            <div class="cabecera">
                <div class="flexible" >
                    <div class="size-cabecera">
                        <div >
                            <label> FECHA PEDIDO:</label>
                        </div>
                        <div>
                            <p>  {{$pedidoConfirmado->updated_at}}</p>
                        </div>
                    </div>
                    <div class="size-cabecera">
                        <div>
                            <label> TOTAL:</label>
                        </div>
                        <div>
                            <p>  {{$pedidoConfirmado->total}}Bs</p>
                        </div>
                    </div>
                </div>
                <div class="margin-inter-div">
                    <div>
                        <label>ENVIAR:</label>
                    </div>
                    <div>
                        <p>  {{$pedidoConfirmado->direction['direction']}}</p>
                    </div>
                </div>
                <div class="flexible">
                    <div class="size-cabecera">
                        <div>
                            <label>ESTADO:</label>
                        </div>
                        <div>
                            <p> {{$pedidoConfirmado->estado}}</p>
                        </div>
                    </div>
                    <div class="size-cabecera">
                        <div>
                            <label>PEDIDO N°:</label>
                        </div>
                        <div>
                            <p> {{$pedidoConfirmado->id}} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @foreach ($pedidoConfirmado->carrito as $carts )
                <div  class="flexible product" style=" padding: 10px;">
                    <div style="width: 27%; text-align: center;">
                    <img src="{{ $message->embed($carts->product->file[0]->path) }}">
                     </div>
                    <div style="width: 57%; padding: 0 5px;"><label>{{$carts->product['name']}}</label><br><span class="redondear-candidad">{{$carts->quantity}}</span></div>
                    <div style="width: 16%; color: rgb(217, 0, 0) !important;"><label>{{$carts->product['price']}} Bs.</label></div>
                </div>
                @endforeach
                <div  class="flexible product" style=" padding: 10px;">
                    <div style="width: 84%; padding: 0 5px;"><label>Envio dentro del 1er y 2do anillo de Montero</label><br><span class="redondear-candidad">{{$carts->quantity}}</span></div>
                    <div style="width: 16%; color: rgb(217, 0, 0) !important;"><label>10 Bs.</label></div>
                </div>
            </div>
            <h5>Esperamos volver a verte pronto.<h5>
            <div style="text-align: center;">
                <a class="fab fa-facebook-f" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
                <a class="fab fa-whatsapp" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
                <a class="far fa-envelope" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
                <a class="fas fa-directions" style="font-size: 25px; color: #293f56; margin-left: 5px; margin-right: 5px;" href="https://www.facebook.com/Ni%C3%B1o-Tienda-111040967171644"></a>
            </div>
        </div>
    </div>
</body>
</html>
