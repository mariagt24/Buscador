
<?php
$tipos=array();

// obtenemos los datos del fichero json 
$lugares_json = file_get_contents('data-1.json');
 
$array_json = json_decode($lugares_json, true);

foreach($array_json as $key => $value){
   $Tipo = $array_json[$key]["Tipo"];
   
   if (!in_array($Tipo,$tipos)) {
   array_push($tipos, $Tipo);
    }
  };
  //$ciudadesuni=array_unique($ciudades);
  //$ciudades=$ciudadesuni;

//print_r ($ciudadesuni);
echo json_encode ($tipos);
//print_r ($ciudades);

?>
