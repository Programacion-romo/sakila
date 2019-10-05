<?php
 
require_once 'idiomas_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $idiomas = new idiomas();
        $resultado = $idiomas->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $idiomas = new idiomas();
		$resultado = $idiomas->nuevo($datos);
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
		$idiomas = new idiomas();
		$resultado = $idiomas->borrar($datos['codigo']);
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
        $idiomas = new idiomas();
        $idiomas->consultar($datos['codigo']);

        if($idiomas->getlanguage_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $idiomas->getlanguage_id(),
                'name' => $idiomas->getname(),
                'last_update' =>$idiomas->getlast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $idiomas = new idiomas();
        $listado = $idiomas->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
