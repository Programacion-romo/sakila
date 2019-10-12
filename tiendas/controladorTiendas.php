<?php
 
require_once 'tiendas_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $tiendas = new tiendas();
        $resultado = $tiendas->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $tiendas = new tiendas();
		$resultado = $tiendas->nuevo($datos);
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
		$tiendas = new tiendas();
		$resultado = $tiendas->borrar($datos['codigo']);
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
        $tiendas = new tiendas();
        $listado = $tiendas->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>