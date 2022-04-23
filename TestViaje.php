<?php
// ******* TestViaje *************
/** Prueba el comportmiento de la clase Viaje */
include("Viaje.php");
include("Pasajeros.php");
include("Responsable.php");

/** METODO CARGAR DATOS 
 * Realiza la carga de datos de los pasajeros.
 * @return array  
 */
function cargaPasajeros(){
    // INT: cantPasajeros, i
    $nombres=array("Pablo","Daniela","Jose","Agustina","Tamara","Alberto","Josefina","Luis","Mirian","Alejandro","Camila","Carlos","Karina","Laura");
    $apellidos=array("Urra","Contreras","Bonfanti","Gallo","Herrera","Urrutia","Ceballos","Saez","Gutierrez","Cabezas","Gonzales","Chostqui","Claros","Genovese");
    $dnis=array(33233814,39051789,38533019,33143839,41233514,31233817,33230014,33275314,31233819,32233714,33233409,33233800,42233814,33257814);
    $telefonos=array(2994000111,2994000911,2994007111,2994003911,2994000771,2994000199,2994870111,2994009811,2994170111,2996800111,2995000111,2994333111,2994000100,2994000110);
    $cantPasajeros=4; // TIENE QUE SER MENOR QUE 14 (CANTIDAD DE NOBRES, APELLIDOS Y DNI)

    // llenado del array multidimensional pasajeros
    for ($i=0; $i<$cantPasajeros;$i++){
        $c=rand(0,13); // selecciona un numero entre 0 y 13 aleatoriamente
        $pasajeros[$i]=new Pasajeros($nombres[$c],$apellidos[$c],$dnis[$c],$telefonos[$c]);

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
    echo(" 3) Cargar los datos del pasajero \n");
    echo(" 4) Salir\n"); 
    echo("-----------------------------------------------------------------------\n");
    $opcion=trim(fgets(STDIN));

    while($opcion>=1 && $opcion<=4){
        return $opcion;

    }// fin while 

}// fin menuOpciones


/**---------- PROGRAMA PRINCIPAL ------------**/
//INT: numOpcion, cambio, k, contar     STRING:      BOOLEAN: salir     ARRAY: viajeros, pasajero1    OBJETOS: viaje,

$numOpcion=menuOpciones(); // llama al metodo menuOpciones para elegir la opcion a ingresar
$salir=false; // opcion para salir del menu de opciones 
$viajeros=cargaPasajeros();// array multidimensional de objetos  pasajeros

// CREACION DEL OBJETO DE LA CLASE VIAJE
$objViaje= new Viaje(1234,"Bariloche",42,$viajeros);  

// CREACION DEL OBJETO RESPONSABLE
$objResponsable=new Responsable("Jose","Gonzales",9125,157);



while($salir==false){
switch ($numOpcion){
    case 1:  // MODIFICA LOS DATOS DEL VIAJE O LOS DEL PASAJERO
        echo("¿Quiere cambiar los datos del pasajero (1) o del viaje (2)?\n");
        $cambio=trim(fgets(STDIN));
        if ($cambio==1){
            $objPasajeroModificado=$objViaje->modificarPasajero($viajeros);// DEVUELVE EL OBJETO PASAJERO CON LOS DATOS MODIFICADOS
            echo("Datos del pasajero modificado: \n");
            echo($objPasajeroModificado);
        }// fin if 
        else{
            $objViaje->modificarViaje();  // MODIFICA LOS DATOS DEL VIAJE (USA LOS METODOS SET PARA LOS MISMOS) 
            echo("\n");
            echo($objViaje); // llama al metodo toString para mostrar los datos modificados del viaje


        }// fin else 
        break;
        
        case 2:  // MUESTRA LOS DATOS DE LOS PASAJEROS Y LOS DATOS DEL VIAJE
            echo("Datos del Viaje: \n");
            echo("----------------------\n");
            echo($objViaje); // Muestra en pantalla los datos del viaje
            echo("Datos de los pasajeros: \n");
            for($k=0; $k<sizeof($viajeros);$k++){ // PARA RECORRER EL ARRAY MULTIDIMENSIONAL  Y MOSTRAR LOS DATOS DE LOS PASAJEROS
                echo($viajeros[$k]."\n");
                echo("--------------------------\n");
            }// fin for
            break;
            
            case 3:
                $objViaje->agregarPasajero();
                break;

            case 4: 
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