<?php

require_once '../Modelo/modelopeliculas.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $peliculas = new peliculas();
        $resultado = $peliculas->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $peliculas = new peliculas();
		$resultado = $peliculas->nuevo($datos);
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
		$peliculas = new peliculas();
		$resultado = $peliculas->borrar($datos['codigo']);
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
        $peliculas = new peliculas();
        $peliculas->consultar($datos['codigo']);

        if($peliculas->getFilm_id() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $peliculas->getFilm_id(),
                'pelicula' => $peliculas->getname(),
                'descripcion' => $peliculas->getDescription(),
                'Año_Estreno' => $peliculas->getRelease_year(),
                'Codigo_idioma' => $peliculas->getLanguage_id(),
                'Ori_codigo_idio' => $peliculas->getOriginal_language_id(),
                'Duracion_alquiler' => $peliculas->getRental_duration(),
                'Tasa_alquiler' => $peliculas->getRental_rate(),
                'Longitud' => $peliculas->getLength(),
                'Costos_remp' => $peliculas->getReplacement_cost(),
                'Clasificacion' => $peliculas->getRating(),
                'Caract_especiales' => $peliculas->getspecial_features(),
                'Actualizacion' =>$peliculas->getlast_update(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $peliculas = new peliculas();
        $listado = $peliculas->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
