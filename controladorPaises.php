<?php
 
require_once '../Modelo/paises_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $paises = new paises();
        $resultado = $paises->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $paises = new paises();
		$resultado = $paises->nuevo($datos);
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
		$paises = new paises();
		$resultado = $paises->borrar($datos['codigo']);
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
        $paises = new paises();
        $paises->consultar($datos['codigo']);

        if($paises->getCountry_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $paises->getCountry_id(),
                'country' => $paises->getCountry(),
                'last_update' =>$paises->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $paises = new paises();
        $listado = $paises->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>