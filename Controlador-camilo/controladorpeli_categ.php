<?php
 
require_once '../Modelo/modelopeli_categ.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $peli_categ = new peli_categ();
        $resultado = $peli_categ->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $peli_categ = new peli_categ();
		$resultado = $peli_categ->nuevo($datos);
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
		$peli_categ = new peli_categ();
		$resultado = $peli_categ->borrar($datos['codigo']);
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
        $peli_categ = new peli_categ();
        $peli_categ->consultar($datos['codigo']);

        if($peli_categ->getFilm_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $peli_categ->getFilm_id(),
                'category_id' => $peli_categ->getCategory_id(),
                'last_update' =>$peli_categ->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $peli_categ = new peli_categ();
        $listado = $peli_categ->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
