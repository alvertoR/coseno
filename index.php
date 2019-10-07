<?php

$cadena1 = "Julie loves me more than Linda loves me";

$cadena2 = "Jane likes me more than Julie loves me";

$prueba = "Jane el mas calvo me Linda";

$db1 = explode(" ",$cadena1);
$db2 = explode(" ",$cadena2);
$arregloPrueba = explode(" ",$prueba);

$dbAi = array();
$dbBi = array();


foreach (contarSimilitud($arregloPrueba,$db1) as $valor) {
    array_push($dbAi, $valor);
}

foreach (contarSimilitud($arregloPrueba,$db2) as $valor) {
    array_push($dbBi, $valor);
}

echo "<h2>Ai</h2><br>";

foreach ($dbAi as $result) {
    echo $result;
}

echo "<br>";
echo "<br>";

echo "<h2>Bi</h2><br>";
foreach ($dbBi as $result) {
    echo $result;
}


echo "<br>";
echo "<br>";

$apoyo=0;
$sumatoria = 0;

$apoyoAi=0;
$sumatoriaAi= 0;

$apoyoBi=0;
$sumatoriaBi=0;

for($i = 0; $i<count($dbAi);$i++){
    $apoyo = $dbAi[$i] * $dbBi[$i];  
    $sumatoria = $apoyo + $sumatoria;  

    $apoyoAi = $sumatoriaAi + $dbAi[$i];
    $sumatoriaAi = $apoyoAi; 

    $apoyoBi = $sumatoriaBi + $dbBi[$i];
    $sumatoriaBi = $apoyoBi; 
    
}

$Ai = sqrt(pow($sumatoriaAi,2));
$Bi = sqrt(pow($sumatoriaBi,2));


$divisor = $sumatoria;
$dividendo = $Ai*$Bi;

$similitud = $divisor/$dividendo;

echo "La frase ingresada se parece un ...".$similitud."a la frase : ".$cadena1;




function contar($array)
{
    $cantidad = array();

    foreach ($array as $palabra) {
        if (isset($cantidad[$palabra])) {
            $cantidad[$palabra] +=1;
        } else {
            $cantidad[$palabra] = 1;
        }
        
    }
    return $cantidad;
}


function contarSimilitud($arrayPrueba,$arrayDb){

    $cantidad = array();

    foreach($arrayPrueba as $palabra){        


        if(in_array($palabra,$arrayDb)){

            foreach($arrayDb as $db) {

                if($palabra == $db){
                    if (isset($cantidad[$palabra])) {
                        $cantidad[$palabra] +=1;
                    } else {
                        $cantidad[$palabra] = 1;
                    }
                }
            }
            

        }else{
            $cantidad[$palabra] = 0;
        }
        
    }
    return $cantidad;
    
}



?>