<?php
    require_once("modeloAbstractoDB.php");
	
    class peli_categ extends ModeloAbstractoDB {
		private $film_id;
		private $category_id;
		private $last_update;
		
		function __construct() {
			//$this->db_category_id = '';
		}

		public function getFilm_id(){
			return $this->film_id;
		}

		public function getCategory_id(){
			return $this->category_id;
		}
		
		public function getLast_update(){
			return $this->last_update;
		}

		public function consultar($film_id='') {
			if($film_id !=''):
				$this->query = "
				SELECT film_id, category_id, last_update
				FROM film_category
				WHERE film_id = '$film_id' order by film_id
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT y.title, x.name, m.last_update
			FROM film_category as m
			inner join film as y on (m.film_id=y.film_id) 
			inner join category as x on (m.category_id=x.category_id)
                 order by title
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('film_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$category_id= utf8_decode($category_id);
				$this->query = "
					INSERT INTO film_category
					(film_id, category_id, last_update)
					VALUES
					(NULL, null,null)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$category_id= utf8_decode($category_id);
			$this->query = "
			UPDATE film_category
			SET category_id='$category_id'
			WHERE film_id = '$film_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($film_id='') {
			$this->query = "
			DELETE FROM film_category
			WHERE film_id = '$film_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>