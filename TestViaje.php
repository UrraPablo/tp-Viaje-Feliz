<?php
// ******* TestViaje *************
/** Prueba el comportmiento de la clase Viaje */
include("Viaje.php");

/** METODO CARGAR DATOS 
 * Realiza la carga de datos de los pasajeros.
 * @return array  
 */
function cargaPasajeros(){
    // INT: cantPasajeros, i
    $nombres=array("Pablo","Daniela","Jose","Agustina","Tamara","Alberto","Josefina","Luis","Mirian","Alejandro","Camila","Carlos","Karina","Laura");
    $apellidos=array("Urra","Contreras","Bonfanti","Gallo","Herrera","Urrutia","Ceballos","Saez","Gutierrez","Cabezas","Gonzales","Chostqui","Claros","Genovese");
    $dnis=array(33233814,39051789,38533019,33143839,41233514,31233817,33230014,33275314,31233819,32233714,33233409,33233800,42233814,33257814);
    $cantPasajeros=4; // TIENE QUE SER MENOR QUE 14 (CANTIDAD DE NOBRES, APELLIDOS Y DNI)

    // llenado del array multidimensional pasajeros
    for ($i=0; $i<$cantPasajeros;$i++){
        $c=rand(0,13); // selecciona un numero entre 0 y 14 aleatoriamente
        $pasajeros[$i]["Nombre"]=$nombres[$c];
        $pasajeros[$i]["Apellido"]=$apellidos[$c];
        $pasajeros[$i]["Dni"]=$dnis[$c];
       // echo("Paso al siguiente pasajero".$i);
    } // fin for 

    return $pasajeros; 
}// fin metodo cargaPasajeros

/** Menu de opciones 
 * Muestra en pantalla las opciones a la que el usuario puede optar.
 * @return int
 */
function menuOpciones(){
    echo("\n");
    echo("---------- ELIJA EL NUMERO DE OPCIÓN AL QUE QUIERE INGRESAR----------\n");
    echo(" 1) Cambiar datos \n");
    echo(" 2) Mostrar datos \n");
    echo(" 3) Salir\n"); 
    echo("-----------------------------------------------------------------------\n");
    $opcion=trim(fgets(STDIN));

    while($opcion>=1 && $opcion<=4){
        return $opcion;

    }// fin while 

}// fin menuOpciones



/**---------- PROGRAMA PRINCIPAL ------------**/
//INT: numOpcion, cambio, k, contar     STRING:      BOOLEAN: salir     ARRAY: viajeros, pasajero1    OBJETOS: viaje, pasajeroViaje

// CREACION DEL OBJETO DE LA CLASE VIAJE
$pasajero1=array("Nombre"=>"Tamara","Apellido"=>"Ruiz","Dni"=>30179543);
// tengo que crear un array pasajero primero para que el objeto no 
// tenga un atributo vacio. 
$objViaje= new Viaje(1234,"Bariloche",42,$pasajero1); // SE USA COMO OBJETO BASE PARA LAS FUTURAS MODIFICACIONES  



$numOpcion=menuOpciones(); // llama al metodo menuOpciones para elegir la opcion a ingresar
$salir=false; // opcion para salir del menu de opciones 
$viajeros=cargaPasajeros();

while($salir==false){
switch ($numOpcion){
    case 1:  // MODIFICA LOS DATOS DEL VIAJE O LOS DEL PASAJERO (LOS DEL VIAJE PERMANECEN INTACTOS)
        echo("¿Quiere cambiar los datos del pasajero (1) o del viaje (2)?\n");
        $cambio=trim(fgets(STDIN));
        if ($cambio==1){
            $pasajeroModificado=$objViaje->modificarPasajero($pasajero1);// DEVUELVE EL ARRAY ASOCIATIVO CON LOS DATOS DEL PASAJERO MODIFICADOS
            $objPasajeroModificado=new Viaje($objViaje->getCodigoViaje(),$objViaje->getDestinoViaje(),$objViaje->getCantMaxima(),$pasajeroModificado);
            echo("\n");
            echo($objPasajeroModificado);// llama al metodo toString para mostrar los datos modificados del pasajero
        }// fin if 
        else{
            $objViaje->modificarViaje();  // MODIFICA LOS DATOS DEL VIAJE (USA LOS METODOS SET PARA LOS MISMOS) 
            echo("\n");
            echo($objViaje); // llama al metodo toString para mostrar los datos modificados del viaje


        }// fin else 
        break;
        
        break;
        case 2:  // MUESTRA LOS DATOS DE LOS PASAJEROS Y LOS DATOS DEL VIAJE
            for($k=0; $k<sizeof($viajeros);$k++){ // PARA RECORRER EL ARRAY MULTIDIMENSIONAL VIAJEROS  Y MOSTRAR LOS DATOS
                $contar=$k+1;
                echo("Pasajero Número: N°".$contar."\n");  
                echo("\n");
                // SUPONEMOS QUE SON LOS PASAJEROS DE UN MISMO VIAJE 
                $objPasajerosViaje=new Viaje($objViaje->getCodigoViaje(),$objViaje->getDestinoViaje(),$objViaje->getCantMaxima(),$viajeros[$k]);
                echo($objPasajerosViaje); 
                echo("\n");
                echo("-------------------------------\n");
                
            }// fin for
            break; 

            case 3: 
                $salir=true;
                break; 


}// fin switch
echo("Desea realizar otra operación: Si / No\n");
echo("-----------------------------------------\n");
$si=strtoupper(trim(fgets(STDIN)));
if($si=="SI"){
    $salir=false;
    $numOpcion=menuOpciones();

}// fin if 
else{
    $salir=true; 
}

}// fin while 





?>