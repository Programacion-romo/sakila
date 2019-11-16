<?php
 
require_once '../Modelo/modeloclientes.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $cliente = new Clientes();
        $resultado = $cliente->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $cliente = new Clientes();
		$resultado = $cliente->nuevo($datos);
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
		$cliente = new Clientes();
		$resultado = $cliente->borrar($datos['codigo']);
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
        $cliente = new Clientes();
        $cliente->consultar($datos['codigo']);

        if($cliente->getcustomer_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $cliente->getcustomer_id(),
                'store_id' => $cliente->getstore_id(),
                'first_name' =>$cliente->getfirst_name(),
                'last_name' => $cliente->getlast_name(),
                'email' => $cliente->getemail(),
                'address_id' =>$cliente->getaddress_id(),
                'active' => $cliente->getactive(),
                'create_date' => $cliente->getcreate_date(),
                'last_update' =>$cliente->getlast_update(),                                
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $cliente = new Clientes();
        $listado = $cliente->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>