<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script type="text/javascript" >
        function inicio(){
            setTimeout("location.href='index.php'", 50);
        }
        function crear_tramo(){
            setTimeout("location.href='crear_tramo.php'", 50);
        }
        function crear_ruta(){
            setTimeout("location.href='crear ruta.php'", 50);
        }
        function crear_sindicato(){
            setTimeout("location.href='crear sindicato.php'", 50);
        }
        function ayuda(){
            setTimeout("location.href='ayuda.php'", 50);
        }

    </script>
</head>
<body>
    <div id="logo" style="float:top;width:100%;height:10%;"><img src="img/logo.jpg" width="100%" height="100%"></div>
    <div id="panel" style="float:left;width:10%;height:90%;">
        <table>
            <tr>
                <td></td>
                <td><strong><input type="button" onclick="inicio()" value="INICIO" style='width:140px; height:25px'></strong></td>
            </tr>
             
             <tr>
                <td></td>
                <td><strong><input type="button" onclick="crear_tramo()" value="CREAR TRAMO" style='width:140px; height:25px'></strong></td>
            </tr>

            <tr>
                <td></td>
                <td><strong><input type="button" onclick="crear_ruta()" value="CREAR RUTA" style='width:140px; height:25px'></strong></td>
            </tr>
             
            <tr>
                <td ></td>
                <td><strong><input type="button" onclick="crear_sindicato()" value="CREAR SINDICATO" style='width:140px; height:25px'></strong></td>
            </tr>

            <tr>
                <td ></td>
                <td><strong><input type="button" onclick="ayuda()" value="AYUDA" style='width:140px; height:25px'></strong></td>
            </tr>
        </table>
       
    </div>
    <div id="map-canvas" style="float:left;width:90%;height:90%;"> <img src="img/asistente.jpg" width="100%" height="100%"></div>
</body>
</html>
<!--  -->