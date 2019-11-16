<?php
 
require_once '../Modelo/modelopagos.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $pagos = new pagos();
        $resultado = $pagos->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $pagos = new pagos();
		$resultado = $pagos->nuevo($datos);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }  else {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }
        echo json_encode($respuesta);
        break;
    case 'borrar':
		$pagos = new pagos();
		$resultado = $pagos->borrar($datos['codigo']);
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
        $pagos = new pagos();
        $pagos->consultar($datos['codigo']);

        if($pagos->getpayment_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $pagos->getpayment_id(),
                'customer_id' => $pagos->getcustomer_id(),
                'staff_id' => $pagos->getstaff_id(),
                'rental_id' => $pagos->getrental_id(),
                'amount' =>$pagos->getamount(),
                'payment_date' => $pagos->getpayment_date(),
                'last_update' =>$pagos->getlast_update(),                                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $pagos = new pagos();
        $listado = $pagos->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>