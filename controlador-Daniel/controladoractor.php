<?php
 
require_once '../Modelo/modeloactor.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $actor = new Actor();
        $resultado = $actor->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $actor = new Actor();
		$resultado = $actor->nuevo($datos);
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
		$actor = new Actor();
		$resultado = $actor->borrar($datos['codigo']);
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
        $actor = new Actor();
        $actor->consultar($datos['codigo']);

        if($actor->getactor_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $actor->getactor_id(),
                'first_name' =>$actor->getfirst_name(),
                'last_name' => $actor->getlast_name(),
                'last_update' =>$actor->getlast_update(),                                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $actor = new Actor();
        $listado = $actor->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>