<?php
 
require_once 'ciudades_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $ciudades = new ciudades();
        $resultado = $ciudades->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $ciudades = new ciudades();
		$resultado = $ciudades->nuevo($datos);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        break;
    case 'borrar':
		$ciudades = new ciudades();
		$resultado = $ciudades->borrar($datos['codigo']);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'consultar':
        $ciudades = new ciudades();
        $ciudades->consultar($datos['codigo']);

        if($ciudades->getCity_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $ciudades->getCity_id(),
                'city' => $ciudades->getCity(),
                'country' => $ciudades->getCountry_id(),
                'last_update' =>$ciudades->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':

        $ciudades = new ciudades();
        $listado = $ciudades->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>