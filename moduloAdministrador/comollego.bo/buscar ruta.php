<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script type="text/javascript" >
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>
     <script type="text/javascript" src="codigo.js"></script>
</head>
<body>
    <div id="logo" style="float:top;width:100%;height:10%;"><img src="img/logo.jpg" width="10%" height="100%"><img src="img/logo.jpg" width="90%" height="100%"></div>
    <div id="panel" style="float:left;width:25%;height:90%;">
         <form action="" method="get">
             <fieldset>
                <legend>como llego</legend>
                    <label  style="width: 20%;float: left;">tipo</label>
                    <select id="tipo" name="tipo_transporte" style="width: 77%;float: left;"onclick="actualiza();">
                        <option value="Bus">apie</option>
                        <option value="Micro">Trasporte publico</option>
                        <option value="Minibus">Trasporte privado</option>
                    </select>
                    <p>
                    <label  style="width: 20%;float: left;">Inicio :</label>
                    <input type="text" style="width: 77%;float: left;"id="inicio" onClick="mm(0)">
                    <p>
                    <label  style="width: 20%;float: left;">Final :</label>
                    <input type="text" style="width: 77%;float: left;"id="final" onClick="mm(1)">
                    <P>
                    <INPUT type="submit" onclick=""value="Buscar Ruta"style="width: 100%;float: left;">
                    <p>
                <legend>
            </fieldset>
        </form>
    </div>
    <div id="mapa" style="float:left;width:75%;height:90%;"> </div>
</body>
</html>
<!--  -->