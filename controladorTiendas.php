<?php
 
require_once '../Modelo/tiendas_modelo.php';
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
        $tiendas = new tiendas();
        $tiendas->consultar($datos['codigo']);

        if($tiendas->getStore_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $tiendas->getStore_id(),
                'Empleado' => $tiendas->getManager_staff_id(),
                'Empleado' => $tiendas->getAddress_id(),
                'last_update' =>$tiendas->getLast_update(),
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