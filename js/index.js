$(document).ready(function() {
var ciudad='';
var tipo='';
var slider ='';
var pdesde = '';
var phasta = '';
$(".itemMostrado").html('');
 CargarCiudades();
 CargarTipos();
 inicializarSlider();


 $("#selectCiudad").change(function(){
  var valor = $(this).val(); // Capturamos el valor del select
  var texto = $(this).find('option:selected').text(); // Capturamos el
        ciudad=valor;
     });

  $("#selectTipo").change(function(){
    var valortip = $(this).val();
    var textipo = $(this).find('option:selected').text(); // Capturamos el
        tipo=valortip;
    });
 

$('#formulario').submit(function(event){
  var slider = $("#rangoPrecio").data("ionRangeSlider");
      pdesde = slider.result.from;
      phasta = slider.result.to;
      
  event.preventDefault(); // evita q el formulario se envie por defecto
  // creamos la peticion ajax en la que definimos el archivo php que recibira la informacio
  
  $.ajax({
        url:'./buscador.php',    
        type: 'POST',
        data:{'ciudad':ciudad,'tipo':tipo,'pdesde':pdesde,'phasta':phasta}
          // solo enviamos el nombre pero podemos enviar todos los q queramos    
        
    }).done(function(adatos){   
      mostrardatos(adatos);
    })
  });
  });

function mostrardatos(adatos){
      resultados=JSON.parse(adatos);  
      var html="<div class='itemMostrado'>";

     $.each(resultados, function(i,value){
      //html+="<div class="+'"'+"itemMostrado"+'"'+">"
      html+="<div class="+'"'+"itemMostrado img"+'"'+"><img src=img/home.jpg>";
      html+="<div><ul><li> Direccion: "+resultados[i].Direccion+"</li>";
      html+="<li> Ciudad: "+ resultados[i].Ciudad+ "</li>";
      html+="<li> Telefono: " + resultados[i].Telefono+"</li>";
      html+="<li> Tipo de casa: " + resultados[i].Tipo+"</li>";
      html+="<li> Precio: " + resultados[i].Precio+"</li></ul>";  
      html+="<div class="+'"'+"divider"+'"'+"></div>";
      html+="<div class="+'"'+"botonField"+'"'+"><input type="+'"'+"submit"+'"';
      html+="class="+'"'+"btn white"+'"'+"value="+'"'+"Ver mas"+'"'+"id="+'"'+"vermas"+'"'+"></div></div></div>";
        });

   $(".itemMostrado").html(html);
}

// la peticion ajax para obtener los datos del json
$('#mostrarTodos').click(function(){
 $.ajax({
    url:'todos.php',
    data: ''
  }
  ).done(function(adatos){
  // mostramos el mensaje recibido en una ventana emergente
       mostrardatos(adatos);

       })
});
/*
  Función que inicializa el elemento Slider
*/

function inicializarSlider(){
  $("#rangoPrecio").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 100000,
    from: 200,
    to: 80000,
    prefix: "$"
  });
}

function CargarCiudades(){
  $.ajax({
        url:'./ciudades.php',
        cache: false,
        contentType: false,
        processData: false,
        data: '',
        type: 'POST',
       success:function(ciudades){   
         var ciudadsel=JSON.parse(ciudades);     
         for (var i=0;i< ciudadsel.length;i++){  
         var insertar ="<option value='"+ciudadsel[i]+"'>"+ciudadsel[i] +"</option>";

        $("#selectCiudad").append(insertar);
      }
    },
    error: function(){
      alert("error al enviar el formulario");
    }
  })
}

/// cargamos los diferentes tipo
function CargarTipos(){

  $.ajax({
        url:'./tipos.php',
        cache: false,
        contentType: false,
        processData: false,
        data: '',
        type: 'post',
       success: function(tipos){   // es importante añadit el parametro data pq ahi se almacena la respuesta del servidor
         var tiposel=JSON.parse(tipos);    
     
        for (var i=0;i< tiposel.length;i++){
    
         var insertartipo ="<option value="+tiposel[i]+">"+tiposel[i] +"</option>";
        $("#selectTipo").append(insertartipo);
      }
    },
    error: function(){
      alert("error al enviar el formulario");
    }
  })
}