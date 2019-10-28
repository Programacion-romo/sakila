<?php
require_once '../Modelo/modeloUsuario.php';

$usuario = htmlspecialchars(trim("$_POST[usuario]"));
$password = htmlspecialchars(trim("$_POST[password]"));
$datos = array("usuario"=>$usuario, "password"=>$password);

switch ($_POST['accion']){
   
    case 'login':
        $usuario = new Usuario();
        $usuario->consultar($datos);

        if($usuario->getUsua_codi() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            if(password_verify($datos['password'],$usuario->getUsua_pass())){
                session_start();
                $_SESSION['usuario'] = $usuario->getUsua_user();
                $_SESSION['nombre'] = $usuario->getUsua_nomb();
                $_SESSION['foto'] = $usuario->getUsua_foto();
                $respuesta = array(
                    'respuesta' =>'existe'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'no existe'
                );
            }
            
        }
        echo json_encode($respuesta);
        break;
    break;
    case 'editar':
        $usuario = new Usuario();
        $resultado = $usuario->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $usuario = new Usuario();
        $resultado = $usuario->nuevo($datos);
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
		$usuario = new Usuario();
		$resultado = $usuario->borrar($datos['codigo']);
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
        $usuario = new Usuario();
        $usuario->consultar($datos['codigo']);

        if($usuario->getlanguage_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $usuario->getlanguage_id(),
                'idioma' => $usuario->getname(),
                'actualizar' =>$usuario->getlast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $usuario = new Usuario();
        $listado = $usuario->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
