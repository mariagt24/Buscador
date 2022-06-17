
<?php
$ciudades=array();

// obtenemos los datos del fichero json 
$lugares_json = file_get_contents('data-1.json');
 
$array_json = json_decode($lugares_json, true);

foreach($array_json as $key => $value){
   $Ciudad = $array_json[$key]["Ciudad"];
   
   if (!in_array($Ciudad,$ciudades)) {
   array_push($ciudades, $Ciudad);
    }
  };
  //$ciudadesuni=array_unique($ciudades);
  //$ciudades=$ciudadesuni;

//print_r ($ciudadesuni);
echo json_encode ($ciudades);
//print_r ($ciudades);


?>
