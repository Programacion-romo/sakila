<?php
 
require_once '../Modelo/direcciones_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $direcciones = new direcciones();
        $resultado = $direcciones->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $direcciones = new direcciones();
		$resultado = $direcciones->nuevo($datos);
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
		$direcciones = new direcciones();
		$resultado = $direcciones->borrar($datos['codigo']);
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
        $direcciones = new direcciones();
        $direcciones->consultar($datos['codigo']);

        if($direcciones->getAddress_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $direcciones->getAddress_id(),
                'address' => $direcciones->getAddress(),
                'address2' => $direcciones->getAddress2(),
                'district' => $direcciones->getDistrict(),
                'city' => $direcciones->getCity_id(),
                'postal_code' => $direcciones->getPostal_code(),
                'phone' => $direcciones->getPhone(),
                'last_update' =>$direcciones->getLast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':

        $direcciones = new direcciones();
        $listado = $direcciones->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>