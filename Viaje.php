<?php
// ********** CLASE Viaje *********************
class Viaje{
/** Esta clase modela el comportamiento de una agencia de viaje. Permite mostrar, modificar y cargar
 * la informacion referente al viaje y a los pasajeros
 */

 // ***ATRIBUTOS***
 private $codigoViaje; // INT
 private $destinoViaje; // STRING
 private $cantMaxima;   // INT
 private $pasajeros;    // ARRAY ASOCIATIVO 
 
 
 // ***CONSTRUCTOR***
 function __construct($codigo,$destino,$asientos,$pasajeros)
 {
     $this->codigoViaje=$codigo;
     $this->destinoViaje=$destino;
     $this->cantMaxima=$asientos;
     $this->pasajeros=$pasajeros;
     
 }// fin constructor 

 // ***METODOS GET***
 function getCodigoViaje(){
    return $this->codigoViaje;
 }// fin metodo get

 function getDestinoViaje(){
    return $this->destinoViaje;

 }// fin metodo get 

 function getCantMaxima(){
    return $this->cantMaxima;

 }// fin metodo get

 function getPasajeros(){
    return $this->pasajeros;
 }// fin metodo get
 
 // ***METODOS SET***
 function setCodigoViaje($codg){
     $this->codigoViaje=$codg;

 }// fin metodo set 

 function setDestinoViaje($destino){
    $this->destinoViaje=$destino;
 }// fin metodo set 

 function setCantMaxima($maximoPasajeros){
    $this->cantMaxima=$maximoPasajeros;
 }// fin metodo set



 // ***METODO MODIFICAR VIAJE***
/** Este metodo pregunta al usuario que de las 3 opciones quiere cambiar: 1) Codigo ; 2)destino y 3) cantidad Maxima
 * 
  */
  function modificarViaje(){
    // STRING: nuevoDestino     INT: opcion , nuevaCantMaxima , nuevoCodigo  
    echo("¿Qué desea cambiar del viaje?.Elija un número de opción: \n");
    echo("1) codigo de viaje   2) destino de viaje   3) cantidad máxima de pasajeros \n");
    $opcion=trim(fgets(STDIN));
    
    // lista de opciones según la elección del usuario
    switch ($opcion){
        case 1:
            echo("Ingrese el nuevo código de viaje: \n");
            $nuevoCodigo=trim(fgets(STDIN));
            $this->setCodigoViaje($nuevoCodigo); 
            break;

            case 2:
                echo("Ingrese el nuevo destino del viaje:  \n");
                $nuevoDestino=trim(fgets(STDIN));
                $this->setDestinoViaje($nuevoDestino);
                break;
                case 3:
                    echo("Ingrese la nueva capacidad máxima de pasajeros: \n");
                    $nuevaCantMaxima=trim(fgets(STDIN));
                    $this->setCantMaxima($nuevaCantMaxima);
                    break;
                    default:
                    echo("la opción elegida de estar entre 1 y 3 \n"); 
                    break;

    }// fin switch

  }// fin metodo modificarVuaje
  
  

 // ***METODO MODIFICAR PASAJERO***
/**Este metodo modifica los datos del pasajero
 * @param pasajero  // array asociativo
 * @return array  
 */
function modificarPasajero($pasajero){
    // STRING: key, eleccion                INT: contar 
    foreach($pasajero as $key=>$dato){
        echo("¿Quiere cambiar ".$key." del pasajero? SI/NO  \n");
        $eleccion=strtoupper(trim(fgets(STDIN)));
        
        // evalua la eleccion del usario pasara saber si entra el while o no
        while($eleccion=="SI"){
            echo("Ingrese el nuevo dato \n");
            $newDato=trim(fgets(STDIN));
            $pasajero[$key]=$newDato;
            $eleccion="NO"; 

        }// fin while 

    }// fin foreach 
    return $pasajero;

}// fin metodo modificarPasajero


 // ***METODO toString***
 function __toString() // INCLUYE LOS DATOS DE UN SOLO PASAJERO 
 {
     return "El viaje con codigo: ".$this->getCodigoViaje()." Tiene capacidad máxima de: ".$this->getCantMaxima()."  pasajeros"."\n".
     "Se dirige al destino: ".$this->getDestinoViaje()."\n".
     "Pasajero/a \n"
     .($this->getPasajeros()["Nombre"])." ".($this->getPasajeros()["Apellido"])."    Dni: ".($this->getPasajeros()["Dni"])."\n";

 }// fin toString 



}// fin clase Viaje





?>