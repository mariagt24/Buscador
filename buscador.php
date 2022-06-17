<?php
$ciudad=$_POST['ciudad'];
$tipo=$_POST['tipo'];
$pdesde=$_POST['pdesde'];
$phasta=$_POST['phasta'];
/*$ciudad='New York';
$tipo='Apartamento';
$pdesde='200';
$phasta='80000';*/


$adatos= array();

if ($ciudad!= '' && $tipo!='') {listaciudadtipo($ciudad,$tipo,$pdesde,$phasta);}
  else if ($ciudad != '') {listaporciudad($ciudad,$pdesde,$phasta);} 
  else if ($tipo!='') {listaportipo($tipo,$pdesde,$phasta);};

function listaciudadtipo($ciudad,$tipo,$pdesde,$phasta){
 $lugares_json = file_get_contents('data-1.json');
 $djson = json_decode($lugares_json, true);  
  foreach($djson as $key => $value) { 
     $precio = $djson[$key]["Precio"];
     $trans=array('$'=>'',','=>'');
     $newprecio=strtr($precio,$trans);
    if (($djson[$key]["Ciudad"]===$ciudad && $djson[$key]["Tipo"]===$tipo)&&($pdesde< $newprecio)&&($newprecio<$phasta)){
    $adatos[]=array('Id'=> $djson[$key]['Id'],
         'Direccion' => $djson[$key]["Direccion"],
         'Ciudad' => $djson[$key]["Ciudad"],
         'Telefono' => $djson[$key]["Telefono"],
         'Codigo_Postal' => $djson[$key]["Codigo_Postal"],
         'Tipo'=> $djson[$key]["Tipo"],
         'Precio' => $djson[$key]["Precio"]);
       }
  }
echo json_encode($adatos);
};

function listaporciudad($ciudad,$pdesde,$phasta) {
  $lugares_json = file_get_contents('data-1.json');
   $djson = json_decode($lugares_json, true);
  foreach($djson as $key => $value) { 
     $precio = $djson[$key]["Precio"];
     $trans=array('$'=>'',','=>'');
     $newprecio=strtr($precio,$trans);
 // echo 'el precio es ' . $precio. 'y el nuevo es ' .$newprecio;

    if (($djson[$key]["Ciudad"]===$ciudad)&&($pdesde<$newprecio)&&($newprecio<$phasta))
    {
    $adatos[]=array('Id'=> $djson[$key]['Id'],
         'Direccion' => $djson[$key]["Direccion"],
         'Ciudad' => $djson[$key]["Ciudad"],
         'Telefono' => $djson[$key]["Telefono"],
         'Codigo_Postal' => $djson[$key]["Codigo_Postal"],
         'Tipo'=> $djson[$key]["Tipo"],
         'Precio' => $djson[$key]["Precio"]);
}
}
echo json_encode($adatos);
};

function listaportipo($tipo,$pdesde,$phasta){
 $lugares_json = file_get_contents('data-1.json');
   $djson = json_decode($lugares_json, true);
  foreach($djson as $key => $value) { 
     $precio = $djson[$key]["Precio"];
     $trans=array('$'=>'',','=>'');
     $newprecio=strtr($precio,$trans);
    if (($djson[$key]["Tipo"]===$tipo)&&($pdesde < $newprecio)&&($newprecio<$phasta)){
    $adatos[]=array('Id'=> $djson[$key]['Id'],
         'Direccion' => $djson[$key]["Direccion"],
         'Ciudad' => $djson[$key]["Ciudad"],
         'Telefono' => $djson[$key]["Telefono"],
         'Codigo_Postal' => $djson[$key]["Codigo_Postal"],
         'Tipo'=> $djson[$key]["Tipo"],
         'Precio' => $djson[$key]["Precio"]);
}
}
echo json_encode($adatos);
};

?>