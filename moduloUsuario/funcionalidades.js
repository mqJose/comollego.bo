function mostrarSindicatos() {
    $("#panelbuscarruta").hide();
    $.ajax({
        "url": "listarsindicatos.php",
        "type": "post",
        "success": function(result) {
            $("#panelfuncionalidad").empty();
            $("#panelfuncionalidad").append("<input id='botonatras' type='button' class='btn btn-info btn-block' href='google.com' value='<= Atras'><br>");
            $("#panelfuncionalidad").append(result);
            $("#botonatras").click(function(){
                $("#panelbuscarruta").show();
                $("#panelfuncionalidad").hide();
            });
            $("#panelfuncionalidad").show();
        },
        "error": function(result) {
            $("#panelbuscarruta").hide();
            $("#panelfuncionalidad").empty();
            $("#panelfuncionalidad").append("<input id='botonatras' class='btn btn-primary btn-block' value='<= Atras'><br>");
            $("#botonatras").click(function(){
                $("#panelbuscarruta").show();
                $("#panelfuncionalidad").hide();
            });
            $("#panelfuncionalidad").html("No se encontraron resultados. ") ;
        },
        "async": false
    });
}
function mostrarLineas() {
    $("#panelbuscarruta").hide();
    $("#panelfuncionalidad").css('height', '30em');



}