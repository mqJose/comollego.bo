<!DOCTYPE html>

<html>
<head>
    <title>inicio</title>
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
    <form action="lista de rutas.php" method="get">
        <fieldset>
            <legend>Como Llego</legend>
            <label  style="width: 20%;float: left;">Tipo:</label>
            <select id = "tipo" name = "tipo_transporte" style = "width: 77%;float: left;" onclick = "actualiza();">
                <option value="WALKING">A pie</option>
                <option value="PUBLICO">Trasporte publico</option>
                <option value="DRIVING">Trasporte privado</option>
            </select>
            <p>
                <label  style="width: 20%;float: left;">Inicio :</label>
                <input type="text" style="width: 77%;float: left;"id="inicio" onClick="mm(0)" required>
            <p>
                <label  style="width: 20%;float: left;">Final :</label>
                <input type="text" style="width: 77%;float: left;"id="final" onClick="mm(1)" required>
            <P>
                <!--Este DIV debe ser ocutlo si o si -->
            <div id="oculto" style='display:none'></div>
            <INPUT type="submit" onclick="" value="Buscar Ruta"style="width: 100%;float: left;">
            <p>
        </fieldset>
    </form>
</div>
<div id="mapa" style="float:left;width:75%;height:90%;"> </div>
</body>
</html>