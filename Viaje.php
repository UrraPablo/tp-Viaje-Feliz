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
 private $pasajeros;    // ARRAY DE OBJETOS
 
 
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

 public function setPasajeros($colPasajero){
    $this->pasajeros=$colPasajero;
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
 * @param viajero  // array de objetos pasajeros 
 * @return obj
 */
function modificarPasajero($viajeros){
    // STRING: key, eleccion                INT: nro    OBJ: objPasajeros   ARRAy: pasajero
    echo("Hay ".sizeof($viajeros)." pasajeros"."\n"."¿Que Nro de pasajero quiere modificar? \n");
    $nro=trim(fgets(STDIN));
    $objPasajero=$viajeros[$nro]; // selecciona al pasajero que va a modificar los datos
    
    // Almacena en una array asociativo los atributos del objeto pasajero. (Para usar la misma estructura del foreach y while)
    $pasajero=array("Nombre"=>$objPasajero->getNombre(),"Apellido"=>$objPasajero->getApellido(),"dni"=>$objPasajero->getDni(),"telefono"=>$objPasajero->getTelefono());

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
    $objPasajero->setNombre($pasajero["Nombre"]);
    $objPasajero->setApellido($pasajero["Apellido"]);
    $objPasajero->setDni($pasajero["dni"]);
    $objPasajero->setTelefono($pasajero["telefono"]);

    return $objPasajero;

}// fin metodo modificarPasajero


/**METODO ESTAPASAJERO
 * buscar en un array de obejtos pasajeros, si el pasajero ingresado ya se encuentra en la coleccion de objetos pasajeros  
 * @param _nombre
 * @param _apellido
 * @param _dni
 * @param _tel
 * @return boolean
 */
private function estaPasajero($_dni){
    // OBJ: arrayObjPasajero, pasajero         INT: contar
    $arrObjPasajeros=$this->getPasajeros(); // almacena el array de objetos pasajeros
    $contar=0;
    $pasajero=$arrObjPasajeros[$contar]; // un objeto (de la clase pasajeros) pasajero del array
    $result=false; // determina si se encuentra o no el pasajero dentro de la colección
    $dniPasajeroColeccion=$pasajero->getDni(); // almacena el DNI del 1er pasajero del array de objetos
    //echo($dniPasajeroColeccion."\n");
    while($_dni!=$dniPasajeroColeccion && $contar<sizeof($arrObjPasajeros)){
        $pasajero=$arrObjPasajeros[$contar]; //  almacena un objeto del array de objetos en la variable pasajero     
        $dniPasajeroColeccion=$pasajero->getDni(); 
        $result=true; 
        $contar=$contar+1;

    }// fin while 

    return $result;


}// fin metodo estaPasajero

/**METODO AGREGAR PASAJERO */
public function agregarPasajero(){
// STRING: nombre, apellido      INT: dni, telefono     BOOLEAN: seRepite   OBJ: colPasajero
echo("Ingrese su nombre: \n");
$nombre=trim(fgets(STDIN));
echo("Ingrese su apellido \n");
$apellido=trim(fgets(STDIN));
echo("Ingrese su DNI \n");
$dni=trim(fgets(STDIN));
echo("Ingrese su telefono \n");
$telefono=trim(fgets(STDIN));

$noSeRepite=$this->estaPasajero($dni);// almacena un boolean dependiendo si el pasajero esta repetido o no
echo(var_dump($noSeRepite));
if ($noSeRepite){
    $tam=sizeof($this->getPasajeros());// determina el tamaño del array
    $colPasajero=$this->getPasajeros();// llama a la coleccion de objetos
    $pasajeroAgregar=new Pasajeros($nombre,$apellido,$dni,$telefono);
    $colPasajero[$tam]=$pasajeroAgregar; // en la última posicion + 1 se guarda el obj pasajero 
    $this->setPasajeros($colPasajero); // modifica la coleccion de pasajeros, agregando al pasajero no repetido 

}
else{
    echo("El pasajero ya se encuentra en la lista de pasajeros\n");

}// fin else 
}// fin metodo agregarPasajero



 // ***METODO toString***
 function __toString() 
 {
     return "El viaje con codigo: ".$this->getCodigoViaje()." Tiene capacidad máxima de: ".$this->getCantMaxima()."  pasajeros"."\n".
     "Se dirige al destino: ".$this->getDestinoViaje()."\n";

 }// fin toString 



}// fin clase Viaje





?>