<?php
 
require_once '../Modelo/modelocategorias.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $categorias = new categorias();
        $resultado = $categorias->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $categorias = new categorias();
		$resultado = $categorias->nuevo($datos);
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
		$categorias = new categorias();
		$resultado = $categorias->borrar($datos['codigo']);
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
        $categorias = new categorias();
        $categorias->consultar($datos['codigo']);

        if($categorias->getCategory_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $categorias->getCategory_id(),
                'name' => $categorias->getname(),
                'last_update' =>$categorias->getlast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $categorias = new categorias();
        $listado = $categorias->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
