<?php
 $lugares_json = file_get_contents('data-1.json');
 $djson = json_decode($lugares_json, true);  
  
  foreach($djson as $key => $value) { 
    
    $adatos[]=array('Id'=> $djson[$key]['Id'],
         'Direccion' => $djson[$key]["Direccion"],
         'Ciudad' => $djson[$key]["Ciudad"],
         'Telefono' => $djson[$key]["Telefono"],
         'Codigo_Postal' => $djson[$key]["Codigo_Postal"],
         'Tipo'=> $djson[$key]["Tipo"],
         'Precio' => $djson[$key]["Precio"]);
       }
  
echo json_encode($adatos);

?>