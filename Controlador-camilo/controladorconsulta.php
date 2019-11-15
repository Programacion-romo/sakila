<?php
 
require_once '../Modelo/modeloconsulta.php';
$datos = $_GET;
switch ($_GET['accion']){
    
    case 'editar':
        $consulta = new consulta();
        $resultado = $consulta->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $consulta = new consulta();
		$resultado = $consulta->nuevo($datos);
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
		$consulta = new consulta();
		$resultado = $consulta->borrar($datos['codigo']);
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
        $consulta = new consulta();
        $consulta->consultar($datos['codigo']);

        if($consulta->getFilm_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $consulta->getFilm_id(),
                'category_id' => $consulta->getCategory_id(),
                'store_id' =>$consulta->getStore_id(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $consulta = new consulta();
        $listado = $consulta->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>